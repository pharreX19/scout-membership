<?php

namespace App;

use App\Role;
use App\Member;
use App\School;
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
        'first_name',
        'last_name',
        'contact',
        'atoll_id',
        'island_id',
        'school_id',
        'email',
        'password',
        'role_id',
        'file_path',
        // 'is_approved'
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
        // 'is_approved' => 'boolean'
    ];
    protected $date = [
        'deleted_at'
    ];

    public static $rules = [
        'first_name' => 'required|alpha_space|max:20',
        'last_name' => 'required|alpha_space|max:20',
        'contact'=> 'numeric|nullable|digits:7',
        'atoll_id' => 'required|numeric|exists:atolls,id',
        'island_id' => 'required|numeric|exists:islands,id',
        'school_id' => 'required|numeric|exists:schools,id',
        'email' => 'required|email|max:20',
        'password' => 'required|string|max:30|confirmed',
        'role_id' => 'numeric|exists:roles,id',
        'profile' => 'nullable|mimes:image,jpg,jpeg,png|max:2048',
        'file_path' => 'nullable|string',

    ];

    public static $updateRules = [
        'first_name' => 'sometimes|alpha_space|max:20',
        'last_name' => 'sometimes|alpha_space|max:20',
        'contact'=> 'numeric|nullable|digits:7',
        'atoll_id' => 'sometimes|numeric|exists:atolls,id',
        'island_id' => 'sometimes|numeric|exists:islands,id',
        'school_id' => 'sometimes|numeric|exists:schools,id',
        'email' => 'sometimes|email|max:20',
        'password' => 'sometimes|string|max:30|confirmed',
        'role_id' => 'numeric|exists:roles,id',
        'profile' => 'nullable|mimes:image,jpg,jpeg,png|max:2048',
        'file_path' => 'nullable|string',
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

    public function members(){
        return $this->hasMany(Member::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
