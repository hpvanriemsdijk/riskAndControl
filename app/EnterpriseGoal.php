<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * EnterpriseGoal.
 */
class EnterpriseGoal extends Node
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'dimention'];

    /**
     * Add ables to identfiers.
     *
     * @var array
     */
    public static $controlDimentions = [0  => 'Financial',
                        1                  => 'Customer',
                        2                  => 'Internal',
                        3                  => 'Learning and Growth', ];

    /**
     * Validationrules.
     */
    public static $validationRules = [
            'name'        => 'required|string|max:255',
            'description' => 'string|max:10000',
            'dimention'   => 'required|integer|between:0,3',
        ];

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
    public static function getGoalTypeLabel($typeId)
    {
        $types = self::$controlDimentions;
        if ($typeId >= 0 && $typeId < 4) {
            return $types[$typeId];
        } else {
            return $types[0];
        }
    }
}
