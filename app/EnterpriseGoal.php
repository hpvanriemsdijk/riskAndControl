<?php namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* EnterpriseGoal
*/
class EnterpriseGoal extends Node {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'dimention'];

	/*
	 * define relations
	 */
	public function threats()
    {
        return $this->morphToMany('App\Threat', 'threat_target');
    }

    /*
     * Model specific functions
     *
     * getAssetTypeLabel; Translate Asset type identifier to label.
     */
    public static function getGoalTypeLabel($typeId){
        $types = ['Financial', 'Customer', 'Internal', 'Learning and Growth'];
        if($typeId >= 0 && $typeId < 4){
            return $types[$typeId]; 
        }else{
            return $types[0]; 
        }        
    }
}
