<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function login(Request $request){
        $credentials = $request->only('email','password');
        $validator = Validator::make($credentials,[
            'email'=>'required|string|max:20',
            'password' => 'required|string|max:50'
        ]);

        if($validator->fails()){
           $this->formatErrors($validator->errors());
            return back();

        }

        if(\Auth::attempt($credentials)){
            if(!\Auth::user()->is_approved){
                \Auth::logout();
                Toastr::info('Please contact your administrator to verify your login');
                return redirect()->to('/login');
            }
            return redirect('/');
        }else{
            Toastr::warning('Invalid Credentials');
            return redirect('login');
        }

    }

    public function logout(){
        \Auth::logout();
        return redirect()->to('/login');
    }
}
