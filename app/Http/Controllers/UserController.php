<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use App\DataTables\UserDataTable;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function __construct(UserRepo $repo)
    {
        $this->model = User::class;
        $this->repo = $repo;
    }

    public function index(Request $request){
        if(Gate::allows('is-admin')){
            $dataTable = new UserDataTable();
            return $dataTable->render('users');
        }else{
            return view('403');
        }

    }

    public function store(Request $request){
        if(Gate::allows('is-admin')){
            $data = $request->all();
            $validator = Validator::make($data, $this->model::$rules);
            if($validator->fails()){
                $this->formatErrors($validator->errors());
                return back()->withInput();
            }
            if($request->hasFile('profile')){
                $uploadedFileName = $this->uploadFile($request->file('profile'));
                $request->request->add(['file_path' => $uploadedFileName]);
            }

            // $result = $this->repo->store($request);
            $result = parent::store($request);
            if($result){
                // Toastr::success('User Created Success!');
                return redirect()->back();
            }
            return 'Error occured!';

        }else{
            return view('403');
        }
    }

}
