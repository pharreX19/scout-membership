<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Repositories\RoleRepo;
use App\Http\Controllers\BaseController;

class RoleController extends BaseController
{
    public function __construct(RoleRepo $repo)
    {
        $this->model = Role::class;
        $this->repo = $repo;
    }
}
