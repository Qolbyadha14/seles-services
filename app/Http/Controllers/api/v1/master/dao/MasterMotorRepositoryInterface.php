<?php

namespace App\Http\Controllers\api\v1\master\dao;

use App\Http\BaseRepositories\RepositoryInterface;

interface MasterMotorRepositoryInterface extends RepositoryInterface
{

    public function allWithRelation();
}
