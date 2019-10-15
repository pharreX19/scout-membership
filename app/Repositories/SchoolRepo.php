<?php

namespace App\Repositories;

use App\School;
use App\Repositories\BaseRepo;

class SchoolRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = School::class;
        $this->with=['atoll','island','members','user'];
    }
}
