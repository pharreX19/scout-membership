<?php

namespace App\Http\Controllers;

use App\Rank;
use Illuminate\Http\Request;
use App\Repositories\RankRepo;
use App\Http\Controllers\BaseController;

class RankController extends BaseController
{
    public function __construct(RankRepo $repo)
    {
        $this->model = Rank::class;
        $this->repo = $repo;
    }

    public function create(){
        return view('newRank');
    }
}
