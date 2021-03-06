<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Improvement extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'status', 'owner_id'];

    /**
     * Add ables to identfiers.
     *
     * @var array
     */
    public static $improvementStatus = [0 => 'To do', 1 => 'In progress', 2 => 'Done'];

    /**
     * Validationrules.
     */
    public static $validationRules = [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'status'      => 'required|integer|between:0,2',
            'owner_id'    => 'required|integer',
        ];

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

        $statusus = self::$improvementStatus;
        $statusLabel = [
            'identifier' => $status,
            'label'      => $label = isset($statusus[$status]) ? $statusus[$status] : false,
            ];

        return $statusLabel;
    }

    /*
     * Model specific functions
     *
     * getAssetTypeLabel; Translate Asset type identifier to label.
     */
    public static function getStatusClass($effectivityId)
    {
        if ($effectivityId['identifier'] == 0) {
            return 'panel-danger';
        } elseif ($effectivityId['identifier'] == 1) {
            return 'panel-warning';
        } elseif ($effectivityId['identifier'] == 2) {
            return 'panel-success';
        } else {
            return 'panel-default';
        }
    }
}
