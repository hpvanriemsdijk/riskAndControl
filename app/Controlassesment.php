<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Controlassesment extends Model {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['start', 'finish', 'finding', 'conclusion'];

    /**
     * The attributes that are appended to the model.
     *
     * @var array
     */
    protected $appends = array('warnings');

    /**
     * Validationrules
     */
    public static $validationRules = [
            'start' => 'required|date',
            'finish' => 'date|after:start',
            'finding' => 'required|string|max:10000',
            'conclusion' => 'required|integer|between:0,3'
        ];

    /**
     * Add ables to identfiers.
     *
     * @var array
     */
    public static $conclusionTypes = [
                    0 => 'Unknown', 
                    1 => 'Not effective', 
                    2 => 'Partly effective', 
                    3 => 'Effective'];


	/*
	 * define relations
	 */
	public function controlactivities()
    {
        return $this->belongsToMany('App\Controlactivity');
    }

    public function auditor()
    {
        return $this->belongsTo('App\User');
    }

    public function auditee()
    {
        return $this->belongsTo('App\User');
    }

    public function approveer()
    {
        return $this->belongsTo('App\User');
    }

    public function controlactivity()
    {
        return $this->belongsTo('App\Controlactivity');
    }

    /*
    public function threat()
    {
        return $this->belongsTo('App\Threat');
    }
    */

    public function deficiencies()
    {
        return $this->hasMany('App\Deficiency');
    }

    /*
     * Add label to the conclusion, 
     * Set conclusion to ineffective if an assesment ia approved, but the conclusion in "Unknown"
     *
     */
    public function getConclusionAttribute()
    {
        $fixed = false;
        $conclusion = $this->attributes['conclusion'];

        //Set conclusion to ineffective if an assesment ia approved, but the conclusion in "Unknown"
        if(isset($this->finish) && $conclusion == 0){
            $conclusion = 1;
            $fixed = true;
        }

        $conclusionLabel = array(
            'identifier' => $conclusion,
            'label' => $label = isset(Controlassesment::$conclusionTypes[$conclusion]) ? Controlassesment::$conclusionTypes[$conclusion] : false,
            'fixed' => $fixed
            );

        return $conclusionLabel;
    }

    /*
     * getWarningsAttribute; Check for unlogical situations
     */
    public function getWarningsAttribute()
    {
        $warnings = array();

        if($this->conclusion['fixed']){
            $warnings[] = array(
                'label' => "The conclusion of this approved assesment was set to 'Unknown', this is not allowed. Relax, the conclusion is automaticly set to 'Not effective'.",
                'severity' => 'danger'
            );
        }

        return $warnings; 
    }

    /*
     * Model specific functions
     *
     * getAssetTypeLabel; Translate Asset type identifier to label.
     */
    public static function getConclusionClass($effectivityId){
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
