<?php

namespace App\Repositories;

use App\Atoll;
use App\Repositories\BaseRepo;

class AtollRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = Atoll::class;
        $this->with=['islands','schools'];
    }


}
