<?php

namespace App\Http\Controllers;

use App\Island;
use Illuminate\Http\Request;
use App\Repositories\IslandRepo;
use App\Http\Controllers\BaseController;

class IslandController extends BaseController
{
    public function __construct(IslandRepo $repo)
    {
        $this->model = Island::class;
        $this->repo=$repo;
    }

    public function create(){
        return view('newIsland');
    }
}
