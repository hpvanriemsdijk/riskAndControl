<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Improvement extends Model {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'status'];

	/*
	 * define relations
	 */
	public function deficiencies()
    {
        return $this->belongsToMany('App\Deficiency');
    }

    public function owner()
    {
        return $this->belongsTo('App\Role');
    }

    /*
     * Add label to the status, 
     *
     */
    public function getStatusAttribute()
    {
        $status = $this->attributes['status'];

        $statusus = ['To do', 'In progress', 'Done'];
        $statusLabel = array(
            'identifier' => $status,
            'label' => $label = isset($statusus[$status]) ? $statusus[$status] : false,
            );

        return $statusLabel;
    }

    /*
     * Model specific functions
     *
     * getAssetTypeLabel; Translate Asset type identifier to label.
     */
    public static function getStatusClass($effectivityId){
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
