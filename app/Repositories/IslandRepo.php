<?php

namespace App\Repositories;

use App\Island;
use App\Repositories\BaseRepo;

class IslandRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = Island::class;
        $this->with=['atoll','schools'];
    }
}
