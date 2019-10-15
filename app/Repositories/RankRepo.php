<?php

namespace App\Repositories;

use App\Rank;
use App\Repositories\BaseRepo;

class RankRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = Rank::class;
        $this->with=['members'];
    }
}
