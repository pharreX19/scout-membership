<?php

namespace App;

use App\User;
use App\Activity;
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

    public static function boot(){
        parent::boot();
        self::updating(function($model){
               foreach($model->getDirty() as $key => $value){
                    $model->activities()->create(['user_id'=>auth()->user()->id, 'attribute' => $key, 'value' => $model->getOriginal($key)]);
               }
        });
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function activities(){
        return $this->morphMany(Activity::class, 'activityable');
    }
}
