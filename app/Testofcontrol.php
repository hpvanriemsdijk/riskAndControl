<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testofcontrol extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'test', 'controlactivity_id'];

    /**
     * Validationrules.
     */
    public static $validationRules = [
            'name'               => 'required|string|max:255',
            'test'               => 'required|string|max:10000',
            'controlactivity_id' => 'string',
        ];

    /*
     * define relations
     */
    public function controlactivity()
    {
        return $this->belongsTo('App\Controlactivity');
    }
}
