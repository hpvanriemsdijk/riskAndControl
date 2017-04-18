<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'active', 'user_id'];

    /**
     * Validationrules.
     */
    public static $validationRules = [
        'name'        => 'required|string|max:255',
        'description' => 'required|string|max:10000',
        'active'      => 'boolean',
    ];

    /*
     * define relations
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ownControlframeworks()
    {
        return $this->hasMany('App\Controlframework', 'owner_id');
    }

    public function ownControlactivities()
    {
        return $this->hasMany('App\Controlactivity', 'owner_id');
    }

    public function ownDeficiencies()
    {
        return $this->hasMany('App\Deficiency', 'owner_id');
    }

    public function ownImprovements()
    {
        return $this->hasMany('App\Improvement', 'owner_id');
    }

    public function ownAssets()
    {
        return $this->hasMany('App\Asset', 'owner_id');
    }

    public function maintainAssets()
    {
        return $this->hasMany('App\Asset', 'maintainer_id');
    }

    public function ownProccess()
    {
        return $this->hasMany('App\Process', 'owner_id');
    }

    public function maintainProcess()
    {
        return $this->hasMany('App\Process', 'maintainer_id');
    }
}
