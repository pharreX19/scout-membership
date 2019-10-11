<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use App\DataTables\UserDataTable;
use Yoeunes\Toastr\Facades\Toastr;
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
        $dataTable = new UserDataTable();
        return $dataTable->render('users');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, $this->model::$rules);
        if($validator->fails()){
            $this->formatErrors($validator->errors());
            return back();
        }
        if($request->hasFile('file')){

            $uploadedFileName = $this->uploadFile($request);
            $request->request->add(['file_path' => $uploadedFileName]);
        }
        $result = $this->repo->store($request);
        if($result){
            Toastr::success('User Created Success! Please login');
            return redirect()->to('/login');
        }
        return 'Error occured!';
    }
}
