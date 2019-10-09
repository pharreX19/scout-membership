<?php

namespace App;

use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','file_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $date = [
        'deleted_at'
    ];

    public static $rules = [
        'name' => 'required|alpha_space|max:20',
        'email' => 'required|email|max:20',
        'password' => 'required|string|max:30|confirmed',
        'role_id' => 'numeric|exists:roles,id',
        'file' => 'nullable|mimes:image,jpg,jpeg,png|max:2048',
        'file_path' => 'nullable|string'
    ];

    public static $updateRules = [

    ];

    public function getAdmin(){
        return $this->where('role_id','=',1)->first();
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}