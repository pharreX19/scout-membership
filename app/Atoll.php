<?php

namespace App;

use App\Island;
use App\Member;
use App\School;
use App\Activity;
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

        'name' => "required|alpha_space|max:20|unique:atolls,name"
    ];

    public static $updateRules = [
        'name' => 'required|alpha_space|max:20:unique'
    ];

    public static function boot(){
        parent::boot();
        self::updating(function($model){
               foreach($model->getDirty() as $key => $value){
                    $model->activities()->create(['user_id'=>auth()->user()->id, 'attribute' => $key, 'value' => $model->getOriginal($key)]);
               }
        });
    }

    public function islands(){
        return $this->hasMany(Island::class);
    }

    public function schools(){
        return $this->hasMany(School::class);
    }

    public function member(){
        return $this->hasMany(Member::class);
    }

    public function activities(){
        return $this->morphMany(Activity::class, 'activityable');
    }
}
