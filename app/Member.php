<?php

namespace App;

use App\School;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'atoll_id',
        'island_id',
        'school_id',
        'birth_date',
        'address',
        'contact',
        'email',
        'joined_date',
        'is_approved'
    ];

    protected $date = [
        'deleted_at'
    ];

    public static $rules = [
        'first_name' => 'alpha_space|string|max:30|required',
        'last_name' => 'alpha_space|string|max:30|required',
        'atoll_id' => 'required|numeric|exists:atolls,id',
        'island_id' => 'required|numeric|exists:islands,id',
        'id_number' => 'string|required|max:8',
        'school_id' => 'required|numeric|exists:schools,id',
        'birth_date' => 'date|required',
        'address'=> 'string|nullable|max:30',
        'contact'=> 'numeric|nullable|digits:7',
        'email' => 'email|nullable|max:30|unique:members',
        'joined_date' => 'date|nullable',
        'is_approved' => 'boolean'
    ];


    public static $updateRules = [
        'first_name' => 'alpha_space|string|max:30|sometimes',
        'last_name' => 'alpha_space|string|max:30|sometimes',
        'atoll_id' => 'sometimes|numeric|exists:atolls,id',
        'island_id' => 'sometimes|numeric|exists:islands,id',
        'id_number' => 'string|sometimes|max:8',
        'school_id' => 'sometimes|numeric|exists:schools,id',
        'birth_date' => 'date|requried',
        'address'=> 'string|nullable|max:30',
        'contact'=> 'numeric|nullable|max:7',
        'email' => 'email|nullable|max:30|unique:members',
        'joined_date' => 'date|sometimes',
        'is_approved' => 'boolean|sometimes'
    ];

    public function setBirthDateAttribute($value){
        $dob = Carbon::parse($value);
        $this->attributes['birth_date']= $dob->format('Y-m-d');
    }

    public function getBirthDateAttribute($value){
        $dob = Carbon::parse($value);
        return $dob->format('d-m-Y');
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
