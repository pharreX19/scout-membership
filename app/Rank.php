<?php

namespace App;

use App\Member;
use App\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public static $rules = [
        'name' => 'string|max:40|required|unique:ranks'
    ];


    public static $updateRules = [
        'name' => 'string|max:40|required|unique:ranks'
    ];

    public static function boot(){
        parent::boot();
        self::updating(function($model){
               foreach($model->getDirty() as $key => $value){
                    $model->activities()->create(['user_id'=>auth()->user()->id, 'attribute' => $key, 'value' => $model->getOriginal($key)]);
               }
        });
    }

    public function members(){
        return $this->hasMany(Member::class);
    }

    public function activities(){
        return $this->morphMany(Activity::class, 'activityable');
    }

}
