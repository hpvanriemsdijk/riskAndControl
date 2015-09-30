<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;
use App\Controlassesment;

class Controlactivity extends Model {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 
		'description', 
        'active',
        'key_control',
        'owner_id',
		'perform_frequency', 
		'test_frequency', 
		'justification', 
		'intref', 
		'extref', 
		'control_type', 
		'control_execution', 
		'control_activitiescol',
		'implementation_status'];

	/**
     * append additional fields to the model
     */
    protected $appends = ['effectivity', 'last_test_conclusion', 'last_tested', 'tests_expired', 'warnings'];

    /**
     * Add ables to identfiers.
     *
     * @var array
     */
    public static $controlTypes = [0 => 'preventive', 1 => 'corrective', 2 => 'detective'];
    public static $controlExecution = [0 => 'manual', 1 => 'automated'];
    public static $implementationStatus = [0 => 'Not implemented', 1 => 'Implemented'];
    public static $performFrequencies = [0 => 'Daily', 1 => 'weekly', 2 => 'bi-weekly', 3 => 'mothly', 4 => 'bi-mothly', 5 => 'quarterly', 6 => 'twice a year', 7 => 'yearly'];

    /**
     * Validationrules
     */
    public static $validationRules = [
            'name' => 'required|max:255|unique:controlactivities,deleted_at',
            'description' => 'required|string|max:10000',
            'active' => 'boolean',
            'key_control' => 'boolean',
            'owner_id' => 'required|integer',
            'perform_frequency' => 'required|integer|between:0,7',
            'test_frequency' => 'required|integer|between:0,7',
            'justification' => 'string|max:10000',
            'intref' => 'max:50|unique:controlactivities,deleted_at',
            'extref' => 'max:50|unique:controlactivities,deleted_at',
            'control_type' => 'required|integer|between:0,2',
            'control_execution' => 'required|integer|between:0,1',
            'control_activitiescol' => 'integer|between:0,1',
            'implementation_status' => 'required|integer|between:0,1',
        ];

	/*
	 * define relations
	 */
	public function controlobjectives()
    {
        return $this->belongsToMany('App\Controlobjective');
    }

    public function testsofcontrol()
    {
        return $this->hasMany('App\Testofcontrol', 'controlactivity_id');
    }

/*
    public function ownControlframeworks()
    {
        return $this->hasMany('App\Controlframework', 'owner_id');
    }
*/
    public function owner()
    {
        return $this->belongsTo('App\Role');
    }

    public function controlassesments()
    {
        return $this->hasMany('App\Controlassesment');
    }

    /*
     * getWarningsAttribute; Check for unlogical situations
     */
    public function getWarningsAttribute()
    {
        $warnings = array();

        //Check if CA has expired tests
        if($this->tests_expired and isset($this->last_tested)){
            $warnings[] = array(
                'label' => "This control activity relies on an expired control assesment. Effectivity will be marked as unknown.",
                'severity' => 'warning'
            );
        }

        //Check if CA has ever been tested
        if(!isset($this->last_tested)){
            $warnings[] = array(
                'label' => "This control activity have never been tested. Effectivity will be marked as unknown.",
                'severity' => 'warning'
            );
        }

        return $warnings; 
    }

    /**
     * Define Accessors & Mutators
     *
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getEffectivityAttribute()
    {
        $lastTest = $this->controlassesments()->whereNotNull('approveer_id')->orderBy('finish','DESC')->take(1)->first();

        //Set conclusion to unknown is item is not implemented; or is not tested
        $unknown = array('identifier' => 0, 'label' => 'Unknown');
        if($this->implementation_status == "Not implemented"){
            $effectivity = $unknown; 
        }else if($this->tests_expired){
            $effectivity = $unknown;
        }else if(!isset($lastTest)){
            $effectivity = $unknown;
        }else{
            //Get the corrected conclusion from the controlAssesment model
            $effectivity = $lastTest->getConclusionAttribute();
        }        

        return $effectivity;
    }


    /*
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getLastTestConclusionAttribute()
    {
        $lastTest = $this->controlassesments()->whereNotNull('approveer_id')->orderBy('finish', 'DESC')->take(1)->first();

        //Set conclusion to unknown is item is not implemented; or test is expired; or is not tested
        $unknown = array('identifier' => 0, 'label' => 'Unknown');
        if(!isset($lastTest)){
            $effectivity = $unknown;
        }else{
            //Get the corrected conclusion from the controlAssesment model
            $effectivity = $lastTest->getConclusionAttribute();
        }        

        return $effectivity;
    }

    /*
     * getLastTestedAttribute; Get the date of the last performed test.
     */
    public function getLastTestedAttribute()
    {
        return $this->controlassesments()->whereNotNull('approveer_id')->max('finish');
    }

    /*
     * getTestsExpiredAttribute; Calculate if the last test is whitin the limit of the test frequency.
     */
    public function getTestsExpiredAttribute()
    {
        $lastTest = Carbon::parse($this->getLastTestedAttribute());
        $testFrequency = $this->attributes['test_frequency'];

        if($this->getLastTestedAttribute()){
            if($testFrequency == 0){
                $testDue = $lastTest->addDay();
            }else if($testFrequency == 1){
                $testDue = $lastTest->addWeek();
            }else if($testFrequency == 2){
                $testDue = $lastTest->addWeeks(2);
            }else if($testFrequency == 3){
                $testDue = $lastTest->addMonth();
            }else if($testFrequency == 4){
                $testDue = $lastTest->addMonths(2);
            }else if($testFrequency == 5){
                $testDue = $lastTest->addMonths(3);
            }else if($testFrequency == 6){
                $testDue = $lastTest->addMonths(6);
            }else if($testFrequency == 7){
                $testDue = $lastTest->addYear();
            }else{
                $testDue = Carbon::now()->subDay(); //Other testFrequency is not valid, test expired 
            }
        }else{
            $testDue = Carbon::now()->subDay(); //No test, test expired.
        }

        return ($testDue < Carbon::now() ? true : false);
    }

    /*
     * Translate integers to english value
     */
    public function getPerformFrequencyAttribute($value)
    {
        return $this->getTestFrequencyLabel($value);
    }

    public function getTestFrequencyAttribute($value)
    {
        return $this->getTestFrequencyLabel($value);
    }

    public function getControlTypeAttribute($value)
    {
        $controlType = ['Preventive', 'Corrective', 'Detective'];
        return (isset($controlType[$value]) ? $controlType[$value] : false);
    }

    public function getControlExecutionAttribute($value)
    {
        $controlExecution = ['Manual', 'Automated'];
        return (isset($controlExecution[$value]) ? $controlExecution[$value] : false);
    }

    public function getImplementationStatusAttribute($value)
    {
        $implementationStatus = ['Not implemented', 'Implemented'];
        return (isset($implementationStatus[$value]) ? $implementationStatus[$value] : false);
    }

    /*
     * Model specific functions
     *
     * getTestFrequencyInDays; Translate test Frequency identifier to days.
     */
    public function getTestFrequencyLabel($value){
        $testFrequency = ['Daily', 'Weekly', 'Bi-weekly', 'Mothly', 'Bi-mothly', 'Quarterly', 'Twice a year', 'Yearly'];
        $testFrequencyLabel = array(
            'identifier' => $value,
            'label' => $label = isset($testFrequency[$value]) ? $testFrequency[$value] : false
            );

        return $testFrequencyLabel;
    }

        /*
     * Model specific functions
     *
     * getAssetTypeLabel; Translate Asset type identifier to label.
     */
    public static function getEffectivityClass($effectivityId){
        if($effectivityId['identifier'] == 0){
            return "panel-default";
        }else if($effectivityId['identifier'] == 1){
            return "panel-danger";
        }else if($effectivityId['identifier'] == 2){
            return "panel-warning";
        }else if($effectivityId['identifier'] == 3){
            return "panel-success";
        }else{
            return "panel-default";
        }
    }
}