<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deficiency extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'rootcause', 'owner_id', 'controlassesment_id'];

    /**
     * append additional fields to the model.
     */
    protected $appends = ['followup'];

    public static $validationRules = [
            'name'                => 'required|string|max:255',
            'owner_id'            => 'required|integer',
            'controlassesment_id' => 'required|integer',
            'description'         => 'required|string|max:10000',
            'rootcause'           => 'string|max:10000',
        ];

    /*
     * define relations
     */
    public function improvements()
    {
        return $this->belongsToMany('App\Improvement');
    }

    public function controlassesment()
    {
        return $this->belongsTo('App\Controlassesment');
    }

    public function owner()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * Define Accessors & Mutators.
     *
     * getEffectivityAttribute; Calculate if the controntrolactivity is effective, based on the last performed test.
     */
    public function getFollowupAttribute()
    {
        $improvements = $this->improvements()->get();
        $fixedAll = true;
        $started = false;

        if (count($improvements) > 0) {
            foreach ($improvements as $improvement) {
                if ($improvement['status']['identifier'] < 2) {
                    $fixedAll = false;
                } elseif ($improvement['status']['identifier'] > 0) {
                    $started = true;
                }
            }

            if ($fixedAll) {
                $status = ['identifier' => 3, 'label' => 'Completed'];
            } elseif ($started) {
                $status = ['identifier' => 2, 'label' => 'Started'];
            } else {
                $status = ['identifier' => 1, 'label' => 'None'];
            }
        } else {
            $status = ['identifier' => 0, 'label' => 'Unknown'];
        }

        return $status;
    }

    /*
     * Model specific functions
     *
     * getAssetTypeLabel; Translate Asset type identifier to label.
     */
    public static function getFollowupClass($followup)
    {
        if ($followup['identifier'] == 1) {
            return 'panel-danger';
        } elseif ($followup['identifier'] == 2) {
            return 'panel-warning';
        } elseif ($followup['identifier'] == 3) {
            return 'panel-success';
        } else {
            return 'panel-default';
        }
    }
}
