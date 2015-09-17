<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
	use Authenticatable, CanResetPassword, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
     * Validationrules
     */
    public static $validationRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed',
    ];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/*
	 * define relations
	 */
	public function roles()
    {
        return $this->hasMany('App\Role');
    }

    public function auditorControlassesments()
    {
        return $this->hasMany('App\Controlassesment', 'auditor_id');
    }

    public function auditeeControlassesments()
    {
        return $this->hasMany('App\Controlassesment', 'auditee_id');
    }

    public function approveerControlassesments()
    {
        return $this->hasMany('App\Controlassesment', 'approveer_id');
    }
}
