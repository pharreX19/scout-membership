<?php

namespace App;

use App\User;
use App\Atoll;
use App\Island;
use App\Member;
use App\Activity;
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
        'island_id' => 'required_with:atoll_id|numeric|exists:islands,id',
        'atoll_id' => 'required_with:island_id|numeric|exists:atolls,id',
    ];

    public static function boot(){
        parent::boot();
        self::updating(function($model){
               foreach($model->getDirty() as $key => $value){
                    $model->activities()->create(['user_id'=>auth()->user()->id, 'attribute' => $key, 'value' => $model->getOriginal($key)]);
               }
        });
    }

    public function atoll(){
        return $this->belongsTo(Atoll::class);
    }

    public function island(){
        return $this->belongsTo(Island::class);
    }

    public function members(){
        return $this->hasMany(Member::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function activities(){
        return $this->morphMany(Activity::class, 'activityable');
    }
}
