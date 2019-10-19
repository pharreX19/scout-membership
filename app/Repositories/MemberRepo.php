<?php

namespace App\Repositories;

use App\Member;
use Illuminate\Http\Request;
use App\Repositories\BaseRepo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use App\Notifications\FormApprovedNotification;

class MemberRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = Member::class;
        $this->with=['atoll','island','school','documents'];
    }

    public function index($request){
        Cache::remember($this->model.'index', 10, function () {
            $this->result = $this->model::with($this->with);
            // if(\Illuminate\Support\Facades\Request::query()){
            //     foreach(\Illuminate\Support\Facades\Request::query() as $key=>$value){
            //         $this->result->where($key,'=',$value);
            //     }
            // }
            if(\Auth::user()->role_id != 1){
                $this->result->where('school_id','=',auth()->user()->school_id);
            }
        });

        return $this->result->latest()->paginate(20);
    }

    public function getPendingMemberPayments(){
        if(Gate::allows('is-admin')){
        return  $this->model::with($this->with)->where('is_approved','=',0)->latest()->paginate(10);
    }else{
        return view('403');
    }
}

    public function searchPending(Request $request){
        if(Gate::allows('is-admin')){
        $query = $request->input( 'query' );
        if($query != ""){
            $pendingPayments = $this->model::where('is_approved','=',0);
            $pendingPayments->where( 'id_number', 'LIKE', '%' . $query . '%' )->orWhere( 'first_name', 'LIKE', '%' . $query . '%' )->orWhere( 'last_name', 'LIKE', '%' . $query . '%' );
            if($pendingPayments->count()>0){
                return $pendingPayments->paginate(5)->setPath('')->appends(array('query' => $request->input('query')));
            }
            return false;
        }
    }else{
        return view('403');
    }

    }

    public function searchMember($request){
        $query = $request->input( 'query' );
        if($query != ""){
            $members = $this->model::where( 'id_number', 'LIKE', '%' . $query . '%' )->orWhere( 'first_name', 'LIKE', '%' . $query . '%' )->orWhere( 'last_name', 'LIKE', '%' . $query . '%' );
            if($members->count()>0){
                return $members->paginate(5)->setPath('')->appends(array('query' => $request->input('query')));
            }
            return false;
        }
    }

    public function updatePending($pendingPayments){
        if(Gate::allows('is-admin')){
        return $this->model::whereIn('id_number',$pendingPayments)->update(['is_approved' => 1]);
    }else{
        return view('403');
    }
}

    // public function readNotification($id){
    //     $notification = auth()->user()->notifications()->where('id',$id)->first();
    //     if($notification){
    //         $notification->markAsRead();
    //         if(auth()->user()->id == 1) {
    //             $id_number = $notification['data']['form_number'];
    //             $record = $this->model::where('id_number', $id_number)->first();
    //             if($record){
    //                 $record->update(['is_approved' => 1]);
    //                 $user = $record->user;
    //                 $user->notify(new FormApprovedNotification($id_number));
    //             }
    //         }
    //     }
    // }
}
