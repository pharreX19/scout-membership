<?php

namespace App\Http\Controllers;

use App\Island;
use App\Member;
use App\School;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){

        return view('dashboard')->with([
            'totalMembers' => count($this->getAllMembers()),
            'totalSchools' => count($this->getAllSchools()),
            'pendingMembers' => count($this->getAllMembers()->where('is_approved','=',0)),
            'topSchools' =>  $this->getTopSchools(),
            'topPending' => $this->getAllPending()
        ]);
    }

    public function getAllIslands(){
        return  Island::all();
    }

    public function getAllSchools(){
        return School::all();
    }

    public function getAllMembers(){
        return Member::all();
    }

    public function getTopSchools(){
        $topSchools = [];
        $data = $this->getAllSchools();
        foreach($data as $record){
            $topSchools[$record->name] = count($record->members);
        }
        return $topSchools;
    }

    public function getAllPending(){
        $topPending=[];
        $data = $this->getAllMembers();
        foreach($data as $record){
            if($record->is_approved == 0){
                if(array_key_exists($record->school->name, $topPending)){
                    $topPending[$record->school->name]+=1;
                }else{
                    $topPending[$record->school->name]=1;
                }
            }
        }
        return $topPending;
    }

}
