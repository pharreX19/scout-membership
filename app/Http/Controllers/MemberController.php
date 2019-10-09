<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use App\Repositories\MemberRepo;
use App\DataTables\MemberDataTable;
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
}
