<?php

namespace App\Http\Controllers;

use App\Atoll;
use App\Repositories\AtollRepo;
use App\Http\Controllers\BaseController;

class AtollController extends BaseController
{
    public function __construct(AtollRepo $repo)
    {
        $this->model = Atoll::class;
        $this->repo = $repo;
    }

    public function create(){
        return view('newAtoll');
    }
}
