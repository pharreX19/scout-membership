<?php

namespace App\Http\Controllers;

use App\User;
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
        if(Gate::allows('is-focal-point',$id)){
            $member = parent::show($id);
            return view('newMembership')->with('member',$member);
        }else{
            return view('403');
        }
    }

    public function store(Request $request){
        if(\Auth::user()->id == 1 ){
            $user_id = User::where('school_id','=',$request->input('school_id'))->pluck('id')->first();
            $request->request->add(['user_id'=>$user_id]);
        }
            return parent::store($request);

    }

    public function update(Request $request,$id){
        if(Gate::allows('is-focal-point',$id)){
            $this->model::$updateRules['email'] = $this->model::$updateRules['email'].','.$id. ',id,deleted_at,NULL';
            $this->model::$updateRules['id_number'] = $this->model::$updateRules['id_number'].','.$id. ',id,deleted_at,NULL';

            return parent::update($request,$id);
        }else{
            return view('403');
        }

    }

    public function printMembers(){
        if(Gate::allows('is-admin')){
            $dataTable = new MemberDataTable();
            return $dataTable->render('users');
        }else{
            return view('403');
        }
    }

    public function memberPayments(){
        if(Gate::allows('is-admin')){
            $pendingPayments = $this->repo->getPendingMemberPayments();
            return view('memberPayments',compact('pendingPayments'));
        }else{
            return view('403');
        }
        // return Datatables::of(Member::query())->addColumn('checkbox', function ($item) {
        //     return '<input type="checkbox" class="flat" name="table_records">';
        // })->rawColumns(['checkbox'])->make(true);

    }

    public function searchPending(Request $request){
        if(Gate::allows('is-admin')){
            if(!$request->input('query')){
                return back();
            }
            $pendingPayments = $this->repo->searchPending($request);
            if ($pendingPayments){
                 return view ('memberPayments', compact('pendingPayments'));
            }else{

                return view ('memberPayments')->with(['message'=>'No Details found. Try to search again !', 'pendingPayments'=> []]);
            }
        }else{
            return view('403');
        }

    }

    public function searchMember(Request $request){
        if(Gate::allows('is-user')){
            $members = $this->repo->searchMember($request);
            if ($members){
                return view ('members', compact('members'));
           }else{
               return view ('members')->with(['message'=>'No Members found. Try to search again !', 'members'=> []]);
           }
        }else{
            return view('403');
        }
    }


    public function download($id){
        if(Gate::allows('is-focal-point',$id)){
        $documentsArray = [];
        $member = $this->repo->show($id);
        $documents = $member->documents;
        $zipFileName = 'myzip.zip';
        $zip = new ZipArchive();
        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE ) === true ){
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
        }

    }else{
        return view('403');
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

