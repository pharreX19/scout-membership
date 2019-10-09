<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = User::class;
        $this->with=['role'];
    }

    public function update(Request $request, $id){
        if($request->has('password') && $request->has('current_password')){
            if(Hash::check($request->input('current_password'), Auth::user()->password)){
                return parent::update($request, $id);
            }else{
                return false;
            }
        }else{
            return parent::update($request, $id);
        }
    }
}
