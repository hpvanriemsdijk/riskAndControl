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
	protected $fillable = ['name', 'description', 'active', 'continuity', 'integrity', 'availability', 'active'];

    /**
     * The attributes that are appended to the model.
     *
     * @var array
     */
    protected $appends = array('warnings');

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
        $types = ['People', 'Application', 'Technology', 'Facility', 'Data'];
        if($typeId >= 0 && $typeId < 5){
            return $types[$typeId]; 
        }else{
            return $types[4]; 
        }        
    }
}
