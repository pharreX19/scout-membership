<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use App\Events\FormSubmitEvent;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{

    protected $model;
    protected $repo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Gate::allows('is-user')){
            return $this->repo->index($request);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('is-user')){
            $data = $request->all();
            dd($data);
            $validator = Validator::make($data, $this->model::$rules);
            if($validator->fails()){
                $this->formatErrors($validator->errors());
                return back()->withInput();
            }
            if($request->hasFile('file')){
                if(is_array($request->file('file'))){
                    foreach($request->file('file') as $file){
                        $fileName = $this->uploadFile($file);
                        Document::create(['file_path'=> $fileName, 'member_id'=> $request->id_number]);
                    }
                }else{
                    $uploadedFileName = $this->uploadFile($request->file('file'));
                    $request->request->add(['file_path' => $uploadedFileName]);
                }
            }
            $result = $this->repo->store($request);
            if($result){
                // if($this->model == 'App\Member'){
                //     event(new FormSubmitEvent($result));
                // }
                Toastr::success('Data created Successfully!');
                return back();
            }
            return 'Error occured!';
        }else{
            return view('403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::allows('is-user')){
            $result = $this->repo->show($id);
        if($result){
            return $result;
        }
        return 'No such record found!';
        }else{
            return view('403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::allows('is-user')){
            $data = $request->all();
        // dd($data);
        $validator = Validator::make($data, $this->model::$updateRules);
        if($validator->fails()){
            return $validator->errors();
        }
        if($request->hasFile('file')){
            if(is_array($request->file('file'))){
                foreach($request->file('file') as $file){
                    $fileName = $this->uploadFile($file);
                    Document::create(['file_path'=> $fileName, 'member_id'=> $request->id_number]);
                }
            }else{
                $uploadedFileName = $this->uploadFile($request->file);
                $request->request->add(['file_path' => $uploadedFileName]);
            }
        }

        $result = $this->repo->update($request, $id);
        if($result){
            Toastr::success('Data updated successfully!');
        }else{
            Toastr::error('Error occured!');
        }
        return back();

    }else{
        return view('403');
    }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('is-admin')){
            $result = $this->repo->destroy($id);
            if($result){
               Toastr::info('record deleted successfully');
               return back();
            }
            return 'an error occured!';
        }else{
            return view('403');
        }

    }

    protected function uploadFile($uploadedFile){
        // if($request->file('file')){
            // $file = $request->file('file');
            $file = $uploadedFile;
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = uniqid().'.'.$fileExtension;
            Storage::disk('local')->putFileAs('public',$file, $fileName);
            return $fileName;
        //}
    }

    public function formatErrors($messages){
        foreach($messages->all() as $message){
            Toastr::error($message);
        }
    }
}
