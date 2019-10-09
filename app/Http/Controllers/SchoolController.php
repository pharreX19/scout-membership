<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use App\Repositories\SchoolRepo;
use App\Http\Controllers\BaseController;

class SchoolController extends BaseController
{
    public function __construct(SchoolRepo $repo)
    {
        $this->model = School::class;
        $this->repo = $repo;
    }

    public function create(){
        return view('newSchool');
    }
}
