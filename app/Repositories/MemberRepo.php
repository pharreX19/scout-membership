<?php

namespace App\Repositories;

use App\Member;
use Illuminate\Http\Request;
use App\Repositories\BaseRepo;
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
                $this->result->where('island_id','=',auth()->user()->island_id);
            }
        });

        return $this->result->paginate(20);
    }

    public function getPendingMemberPayments(){
        return  $this->model::with($this->with)->where('is_approved','=',0)->paginate(10);
    }

    public function searchPending(Request $request){
        $query = $request->input( 'query' );
        if($query != ""){
            $pendingPayments = $this->model::where ( 'id_number', 'LIKE', '%' . $query . '%' )->orWhere( 'first_name', 'LIKE', '%' . $query . '%' )->orWhere( 'last_name', 'LIKE', '%' . $query . '%' )->paginate(5)->setPath('');
            $pendingPayments->appends(array('query' => $request->input('query')));
            return $pendingPayments;
        }
    }

    public function readNotification($id){
        $notification = auth()->user()->notifications()->where('id',$id)->first();
        if($notification){
            $notification->markAsRead();
            if(auth()->user()->id == 1) {
                $id_number = $notification['data']['form_number'];
                $record = $this->model::where('id_number', $id_number)->first();
                if($record){
                    $record->update(['is_approved' => 1]);
                    $user = $record->user;
                    $user->notify(new FormApprovedNotification($id_number));
                }
            }
        }
    }
}
