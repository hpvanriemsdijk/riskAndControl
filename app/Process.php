<?php namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Node {
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'ref', 'description', 'owner_id', 'maintainer_id'];

    /**
     * append additional fields to the model
     */
    protected $appends = ['in_control'];

    /**
     * Validationrules
     */
    public static $validationRules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'ref' => 'string|max:50'
        ];

	/*
	 * define relations
	 */
	public function assets()
    {
        return $this->belongsToMany('App\Asset');
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

    /**
     * Define Accessors & Mutators
     *
     * getInControlAttribute; Calculate if the coltrolactivities for the proces threats are effective
     */
    public function getInControlAttribute()
    {
        //return $this->threats()->get(); //@todo, fist neet in controll for the threat
        return 1;
    }
}
