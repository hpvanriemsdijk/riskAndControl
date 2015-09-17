<?php namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;

class Threat extends Node {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'chance', 'impact'];

    /**
     * append additional fields to the model
     */
    protected $appends = ['risk', 'teec', 'residual_risk', 'net_teec', 'net_risk'];

    /**
     * Validationrules
     */
    public static $validationRules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'chance' => 'required|integer|between:0,5',
            'impact' => 'required|integer|between:0,5'
        ];

	/*
	 * define relations
	 */
	public function controlobjectives()
    {
        return $this->belongsToMany('App\Controlobjective')->withPivot('eec');
    }

    /*
    public function controlassesments()
    {
        return $this->hasMany('App\Controlassesment');
    }
    */

    public function assets()
    {
        return $this->morphedByMany('App\Asset', 'threat_target');
    }

    public function enterpriseGoals()
    {
        return $this->morphedByMany('App\EnterpriseGoal', 'threat_target');
    }

    public function processes()
    {
        return $this->morphedByMany('App\Process', 'threat_target');
    }

    /**
     * Define Accessors & Mutators
     *
     * getInControlAttribute; Calculate if the coltrolactivities for the proces threats are effective
     */
    public function getRiskAttribute()
    {
        return $this->chance * $this->impact;
    }

    /*
     * getInControlAttribute; Calculate if the coltrolactivities for the proces threats are effective
     */
    public function getTeecAttribute()
    {
        return $this->getEffectivityIndicators()['teec'];
    }

    /*
     * getInControlAttribute; Calculate if the coltrolactivities for the proces threats are effective
     */
    public function getResidualRiskAttribute()
    {
        $teec = $this->getTeecAttribute();
        $risk = $this->getRiskAttribute();
        return $risk - ($risk * ($teec/100));
    }

    /*
     * getInControlAttribute; Calculate if the coltrolactivities for the proces threats are effective
     */
    public function getNetTeecAttribute()
    {
        return $this->getEffectivityIndicators()['nteec'];
    }

    /*
     * getInControlAttribute; Calculate if the coltrolactivities for the proces threats are effective
     */
    public function getNetRiskAttribute()
    {
        $teec = $this->getNetTeecAttribute();
        $risk = $this->getRiskAttribute();
        return $risk - ($risk * ($teec/100));
    }

    private function getEffectivityIndicators(){
        $effectivityIndicators = array('teec' => 0, 'nteec' => 0);

        foreach($this->controlobjectives as $controlobjective){
            //teec
            $effectivityIndicators['teec'] += $controlobjective->pivot->eec;

            //nteec
            if($controlobjective['effectivity']['identifier'] == 3){
                $effectivityIndicators['nteec'] += $controlobjective->pivot->eec;
            }else if($controlobjective['effectivity']['identifier'] == 2){
                $effectivityIndicators['nteec'] += $controlobjective->pivot->eec * 0.5;
            }
        }

        foreach($effectivityIndicators as $key => $indicator){
            if($indicator > 100){
                $effectivityIndicators[$key] = 100;
            }
        }

        return $effectivityIndicators;
    }
}