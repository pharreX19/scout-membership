<?php

namespace App\Http\Controllers;

use App\Member;
use App\Document;
use Illuminate\Http\Request;
use App\Repositories\MemberRepo;
use App\DataTables\MemberDataTable;
use App\Http\Controllers\BaseController;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\Console\Input\Input;

class MemberController extends BaseController
{
    public function __construct()
    {
        $this->model = Member::class;
        $this->repo = new \App\Repositories\MemberRepo();
    }

    public function index(Request $request){
        $data = parent::index($request);
        return view('members')->with('members',$data);

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

    public function memberPayments(){
        // return Datatables::of(Member::query())->addColumn('checkbox', function ($item) {
        //     return '<input type="checkbox" class="flat" name="table_records">';
        // })->rawColumns(['checkbox'])->make(true);
            $pendingPayments = $this->repo->getPendingMemberPayments();
            return view('memberPayments',compact('pendingPayments'));
    }

    public function searchPending(Request $request){
        if(!$request->input('query')){
            return back();
        }
        $pendingPayments = $this->repo->searchPending($request);
        if (count($pendingPayments) > 0){
             return view ('memberPayments', compact('pendingPayments'));
        }
             return view ('memberPayments')->withMessage('No Details found. Try to search again !');
    }

    public function readNotification($id){
        return $this->repo->readNotification($id);
    }
}
