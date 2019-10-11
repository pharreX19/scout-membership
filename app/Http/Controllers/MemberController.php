<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use App\Repositories\MemberRepo;
use App\DataTables\MemberDataTable;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\BaseController;

class MemberController extends BaseController
{
    public function __construct(MemberRepo $repo)
    {
        $this->model = Member::class;
        $this->repo = $repo;
    }

    public function index(Request $request){
        $dataTable = new MemberDataTable();
        return $dataTable->render('members');
    }

    public function create()
    {
        return view('newMembership');
    }


    public function edit($id)
    {
        $member = $this->repo->show($id);
        return view('newMembership')->with('member',$member);
    }

    public function update(Request $request,$id){
        $this->model::$updateRules['email'] = $this->model::$updateRules['email'].','.$id;
        return parent::update($request,$id);
    }
}
