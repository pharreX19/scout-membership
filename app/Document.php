<?php

namespace App;

use App\Member;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'file_path',
        'member_id'
    ];

    public static $rules = [
        'file_path' => 'string|required',
        'member_id' => 'string|required|max:7'
    ];

    public static $updateRules = [
        'file_path' => 'string|required',
        'member_id' => 'numeric|required|max:7'
    ];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}
