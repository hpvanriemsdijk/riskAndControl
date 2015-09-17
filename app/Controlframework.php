<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Controlframework extends Model {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'active', 'owner_id'];

	/**
     * append additional fields to the model
     */
    protected $appends = ['objectives_met', 'objectives_partly_met', 'objectives_not_met'];

    /**
     * Validationrules
     */
    public static $validationRules = [
            'name' => 'required|max:255|unique:controlframeworks,deleted_at',
            'description' => 'required|string|max:255',
            'active' => 'boolean',
            'owner_id' => 'required|integer'
        ];

	/*
	 * define relations
	 */
	public function controlobjectives()
    {
        return $this->belongsToMany('App\Controlobjective');
    }

    public function owner()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * Define Accessors & Mutators
     *
     * getObjectivesMetAttribute; Count how many objectives are met
     */
    public function getObjectivesMetAttribute()
    {
       	return $this->getObjectiveResultCount()['met'];
    }

    /*
     * getObjectivesPartlyMetAttribute; Count how many objectives are partly met
     */
    public function getObjectivesPartlyMetAttribute()
    {
        return $this->getObjectiveResultCount()['partlyMet'];
    }

    /*
     * getObjectivesNotMetAttribute; Count how many objectives are not met
     */
    public function getObjectivesNotMetAttribute()
    {
        return $this->getObjectiveResultCount()['notMet'];
    }

     /*
     * Model specific functions
     *
     * getTestFrequencyInDays; Translate test Frequency identifier to days.
     */
    private function getObjectiveResultCount(){
    	$objectiveResult = array('notMet' => 0, 'partlyMet' => 0, 'met' =>0);
    	$controlobjectives = $this->controlobjectives()->where(['active' => 1])->get();

    	foreach ($controlobjectives as $key => $controlobjective) {
    		if($controlobjective['effectivity']['identifier'] <= 1){
    			$objectiveResult['notMet']++;
    		}else if($controlactivity['effectivity']['identifier'] == 2){
    			$objectiveResult['PartlyMet']++;
    		}else if($controlactivity['effectivity']['identifier'] == 3){
    			$objectiveResult['Met']++;
    		}
    	}

    	return $objectiveResult;
    }
}