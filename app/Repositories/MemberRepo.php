<?php

namespace App\Repositories;

use App\Member;
use App\Repositories\BaseRepo;

class MemberRepo extends BaseRepo
{
    public function __construct()
    {
        $this->model = Member::class;
        $this->with=['school'];
    }
}
