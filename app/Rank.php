<?php

namespace App;

use App\Member;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = [
        'name'
    ];

    public static $rules = [
        'name' => 'string|max:40|required|unique:ranks'
    ];


    public static $updateRules = [
        'name' => 'string|max:40|required|unique:ranks'
    ];

    public function members(){
        return $this->hasMany(Member::class);
    }

}