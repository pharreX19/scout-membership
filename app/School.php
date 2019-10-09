<?php

namespace App;

use App\Atoll;
use App\Island;
use App\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'island_id',
        'atoll_id'
    ];
    protected $date = [
        'deleted_at'
    ];

    public static $rules = [
        'name' => 'alpha_space|required|max:50',
        'island_id' => 'required|numeric|exists:islands,id',
        'atoll_id' => 'required|numeric|exists:atolls,id',
    ];

    public static $updateRules = [
        'name' => 'alpha_space|sometimes|max:50',
        'island_id' => 'sometimes|numeric|exists:islands,id',
        'atoll_id' => 'sometimes|numeric|exists:atolls,id',
    ];

    public function atoll(){
        return $this->belongsTo(Atoll::class);
    }

    public function island(){
        return $this->belongsTo(Island::class);
    }

    public function members(){
        return $this->hasMany(Member::class);
    }
}
