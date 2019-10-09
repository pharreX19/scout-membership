<?php

namespace App;

use App\Island;
use App\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atoll extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $date = [
        'deleted_at'
    ];

    public static $rules = [
        'name' => 'required|alpha_space|max:20:unique'
    ];

    public static $updateRules = [
        'name' => 'required|alpha_space|max:20:unique'
    ];

    public function islands(){
        return $this->hasMany(Island::class);
    }

    public function schools(){
        return $this->hasMany(School::class);
    }
}
