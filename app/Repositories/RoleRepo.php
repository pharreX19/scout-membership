<?php

namespace App\Repositories;

use App\Role;
use App\Repositories\BaseRepo;

class RoleRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = Role::class;
        $this->with=['users'];
    }
}
