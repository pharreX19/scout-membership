<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $fillable = [
        'activityable_type',
        'activityable_id',
        'attribute',
        'value',
        'user_id'
    ];

    public function activityable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
