<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];
    protected $date = [
        'deleted_at'
    ];

    public static $rules = [
        'name' => 'required|alpha|max:10|unique:roles'
    ];

    public static $updateRules = [
        'name' => 'sometimes|alpha|max:10|unique:roles'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
