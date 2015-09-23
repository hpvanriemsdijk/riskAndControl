<?php namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Node {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'active', 'owner_id', 'maintainer_id', 'continuity', 'integrity', 'availability', 'type'];

    /**
     * The attributes that are appended to the model.
     *
     * @var array
     */
    protected $appends = array('warnings');


    /**
     * Add ables to identfiers.
     *
     * @var array
     */
    public static $assetTypes = ['People', 'Application', 'Technology', 'Facility', 'Data'];

    /**
     * Validationrules
     */
    public static $validationRules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'active' => 'boolean',
            'owner_id' => 'required|integer',
            'maintainer_id' => 'required|integer',
            'continuity' => 'required|integer|between:0,5',
            'integrity' => 'required|integer|between:0,5',
            'availability' => 'required|integer|between:0,5',
            'type' => 'required|integer|between:0,5'
        ];

	/*
	 * define relations
	 */
	public function processes()
    {
        return $this->belongsToMany('App\Process');
    }

    public function owner()
    {
        return $this->belongsTo('App\Role');
    }

    public function maintainer()
    {
        return $this->belongsTo('App\Role');
    }

    public function threats()
    {
        return $this->morphToMany('App\Threat', 'threat_target');
    }

    /*
     * getWarningsAttribute; Check for unlogical situations
     */
    public function getWarningsAttribute()
    {
        $warnings = array();

        //Chech if child classification is higher than the parent classification
        $violation = false;
        $c = $this->attributes['continuity'];
        $i = $this->attributes['integrity'];
        $a = $this->attributes['availability'];

        $descendants = $this->getDescendants(array('continuity', 'integrity', 'availability'));

        foreach ($descendants as $descendant) {
            if($descendant['continuity'] > $c || $descendant['integrity'] > $i || $descendant['availability'] > $a){
                $violation = true;
            }
        }

        if($violation){
            $warnings[] = array(
                'label' => "The classification of your asset is lower than the classification of it's children.",
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
    public static function getAssetTypeLabel($typeId){
        if($typeId >= 0 && $typeId < 5){
            return Asset::$assetTypes[$typeId]; 
        }else{
            return Asset::$assetTypes[4]; 
        }        
    }
}
