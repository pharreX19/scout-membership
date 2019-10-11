<?php

namespace App;

use App\Atoll;
use App\Member;
use App\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Island extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'atoll_id'
    ];

    protected $date = [
        'deleted_at'
    ];

    public static $rules = [
        'name' => 'required|alpha_space|max:20',
        'atoll_id' => 'required|numeric|exists:atolls,id'
    ];

    public static $updateRules = [
        'name' => 'sometimes|alpha_space|max:20',
        'atoll_id' => 'sometimes|numeric|exists:atolls,id'
    ];

    public function atoll(){
        return $this->belongsTo(Atoll::class);
    }

    public function schools(){
        return $this->hasMany(School::class);
    }

    public function member(){
        return $this->hasMany(Member::class);
    }
}
