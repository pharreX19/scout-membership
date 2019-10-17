<?php

namespace App\Http\Controllers;

use App\Member;
use ZipArchive;
use App\Document;
use Illuminate\Http\Request;
use App\Repositories\MemberRepo;
use App\DataTables\MemberDataTable;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Response;
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
        if(Gate::allows('is-user')){
            $this->model::$updateRules['email'] = $this->model::$updateRules['email'].','.$id;
            return parent::update($request,$id);
        }else{
            return view('403');
        }

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


    public function download($id){
        if(Gate::allows('is-user')){
        $documentsArray = [];
        $member = $this->repo->show($id);
        $documents = $member->documents;
        $zipFileName = 'myzip.zip';
        $zip = new ZipArchive();
        if ($zip->open($zipFileName, ZipArchive::CREATE ) === true ){
        foreach($documents as $document){
            $file_path = storage_path() . "/app/public/" . $document->file_path;
            $zip->addFile($file_path);
        }
        $headers = array(
            'Content-Type: application/pdf',
            'Content-Disposition: attachment; filename='.$document->file_path,
        );
        $zip->close();

        return \Response::download($zipFileName, $zipFileName, $headers );
        }else{
            return view('403');
        }

    }
}

    public function updatePending(Request $request){
        $data = $request->all();
        $filteredArray = array_filter($data['data']);
        return $this->repo->updatePending($filteredArray);
    }

    // public function readNotification($id){
    //     return $this->repo->readNotification($id);
    // }
}

