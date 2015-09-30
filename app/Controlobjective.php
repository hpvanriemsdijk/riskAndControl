<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Controlobjective extends Model {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'intref', 'extref', 'active'];

	/**
     * append additional fields to the model
     */
    protected $appends = ['effectivity', 
                'tests_expired',
                'tests_current', 
                'untested',
                'activies_planned',
                'activities_not_effective',
                'activities_partly_effective',
                'activities_efective',
                'warnings', 
                'eec'];

    /**
     * Validationrules
     */
    public static $validationRules = [
            'name' => 'required|string|max:255|unique:assets,deleted_at',
            'description' => 'required|string|max:10000',
            'active' => 'boolean',
            'intref' => 'string|max:50',
            'extref' => 'string|max:50'
        ];

	/*
	 * define relations
	 */
	public function controlframeworks()
    {
        return $this->belongsToMany('App\Controlframework');
    }

    public function controlactivities()
    {
        return $this->belongsToMany('App\Controlactivity');
    }

    public function threats()
    {
        return $this->belongsToMany('App\Threat')->withPivot('eec');
    }

    /**
     * Define Accessors & Mutators
     *
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getEffectivityAttribute()
    {
        $controlactivities = $this->controlactivities()->where(['key_control' => 1])->where('active', 1)->get();
        $lowest = array("identifier" => 10); //random High value

     	foreach ($controlactivities as $key => $controlactivity) {
    		if($controlactivity['effectivity']['identifier'] < $lowest['identifier']){
    			$lowest = $controlactivity['effectivity'];
    		}
    	}   

        //If lowest status is unknown, the effectivity label is ineffective
        if($lowest["identifier"] == 10){
           $lowest["label"] = "Ineffective";
        } 

    	return $lowest;
    }

    /*
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getTestsExpiredAttribute()
    {
        return $this->getTestExpirationCount()['expired'];
    }

    /*
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getTestsCurrentAttribute()
    {
        return $this->getTestExpirationCount()['current'];
    }

    /*
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getUntestedAttribute()
    {
        return $this->getTestExpirationCount()['untested'];
    }

    /*
     * getActiviesPlannedAttribute; Get sum of all planned activities
     */
    public function getActiviesPlannedAttribute()
    {
        $controlactivities = $this->controlactivities()->where(['implementation_status' => 0])->where('active', 1)->get();
        $implementationStatusCount = array(
            'key_control' => 0,
            'nonkey_control' => 0,
            'total' => 0
        );

        foreach ($controlactivities as $key => $controlactivity) {
            $implementationStatusCount['total']++; 
            if($controlactivity['key_control'] == 0){
                $implementationStatusCount['nonkey_control']++;
            }else{
               $implementationStatusCount['key_control']++; 
            }
        }

        return $implementationStatusCount;
    }

    /*
     * getActivitiesNotEffectiveAttribute; Get sum of all planned activities
     */
    public function getActivitiesNotEffectiveAttribute()
    {
        return $this->getActivityEffectivenessCount()['notEfective'];
    }

    /*
     * getActiviesPlannedAttribute; Get sum of all planned activities
     */
    public function getActivitiesPartlyEffectiveAttribute()
    {
        return $this->getActivityEffectivenessCount()['partialEffective'];
    }

    /*
     * getActiviesPlannedAttribute; Get sum of all planned activities
     */
    public function getActivitiesEfectiveAttribute()
    {
        return $this->getActivityEffectivenessCount()['effective'];
    }

    /*
     * getWarningsAttribute; Check for unlogical situations
     */
    public function getWarningsAttribute()
    {
        $controlactivities = $this->controlactivities()->where('active', 1);
        $warnings = array();

        if($controlactivities->where('key_control', 1)->count() == 0){
            $warnings[] = array(
                'label' => "No key-controls defined, this control can never be effective.",
                'severity' => 'warning'
            );
        }

        return $warnings; 
    }

    /*
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getEecAttribute()
    {
        if(isset($this->pivot)){
            return $this->pivot->eec;
        }else{
            return null;
        }
    }


    /*
     * Model specific functions
     *
     * getTestFrequencyInDays; Translate test Frequency identifier to days.
     */
    private function getTestExpirationCount(){
    	$controlactivities = $this->controlactivities()->where('implementation_status', 1)->where('active', 1)->get();
        $testExpirationCount = array(
            'untested' => array(
                'key_control' => 0,
                'nonkey_control' => 0,
                'total' => 0
            ), 
            'expired' => array(
                'key_control' => 0,
                'nonkey_control' => 0,
                'total' => 0
            ), 
            'current'  => array(
                'key_control' => 0,
                'nonkey_control' => 0,
                'total' => 0
            )
        );

    	foreach ($controlactivities as $key => $controlactivity) {
    		if($controlactivity['last_tested'] == null){
                $testExpirationCount['untested']['total']++; 
                if($controlactivity['key_control'] == 0){
                    $testExpirationCount['untested']['nonkey_control']++;
                }else{
                   $testExpirationCount['untested']['key_control']++; 
                }
    		}else if($controlactivity['tests_expired']){
                $testExpirationCount['expired']['total']++; 
                if($controlactivity['key_control'] == 0){
                    $testExpirationCount['expired']['nonkey_control']++;
                }else{
                   $testExpirationCount['expired']['key_control']++; 
                }
    		}else{
                $testExpirationCount['current']['total']++; 
                if($controlactivity['key_control'] == 0){
                    $testExpirationCount['current']['nonkey_control']++;
                }else{
                   $testExpirationCount['current']['key_control']++; 
                }
    		}
    	}

    	return $testExpirationCount;
    }

    /*
     * Model specific functions
     *
     * getActivityEffectivenessCount; Count te effectiveness of the acticities.
     */
    private function getActivityEffectivenessCount(){
        $controlactivities = $this->controlactivities()->where('implementation_status', 1)->where('active', 1)->get();
        $effectivityActivities = array(
            'notEfective' => array(
                'key_control' => 0,
                'nonkey_control' => 0,
                'total' => 0
            ), 
            'partialEffective' => array(
                'key_control' => 0,
                'nonkey_control' => 0,
                'total' => 0
            ), 
            'effective'  => array(
                'key_control' => 0,
                'nonkey_control' => 0,
                'total' => 0
            )
        );

        foreach ($controlactivities as $key => $controlactivity) {
            if($controlactivity['effectivity']['identifier'] == 1){
                $effectivityActivities['notEfective']['total']++; 
                if($controlactivity['key_control'] == 0){
                    $effectivityActivities['notEfective']['nonkey_control']++;
                }else{
                   $effectivityActivities['notEfective']['key_control']++; 
                }
            }else if($controlactivity['effectivity']['identifier'] == 2){
                $effectivityActivities['partialEffective']['total']++; 
                if($controlactivity['key_control'] == 0){
                    $effectivityActivities['partialEffective']['nonkey_control']++;
                }else{
                   $effectivityActivities['partialEffective']['key_control']++; 
                }
            }else if($controlactivity['effectivity']['identifier'] == 3){
                $effectivityActivities['effective']['total']++; 
                if($controlactivity['key_control'] == 0){
                    $effectivityActivities['effective']['nonkey_control']++;
                }else{
                   $effectivityActivities['effective']['key_control']++; 
                }
            }
        }

        return $effectivityActivities;
    }

    /*
     * Model specific functions
     *
     * getAssetTypeLabel; Translate Asset type identifier to label.
     */
    public static function getEffectivityClass($effectivityId){
        if($effectivityId['identifier'] == 0){
            return "panel-danger";
        }else if($effectivityId['identifier'] == 1){
            return "panel-warning";
        }else if($effectivityId['identifier'] == 2){
            return "panel-success";
        }else{
            return "panel-default";
        }
    }
}
