<?php

namespace App\Http\Controllers\api\v1\master\dao;

use App\Http\BaseRepositories\BaseRepository;
use App\Http\Controllers\api\v1\auth\dao\UserRepositoryInterface;
use App\Models\Master_kendaraan;
use App\Models\Master_mobil;
use App\Models\Master_motor;

class MasterMotorRepository extends BaseRepository implements MasterMotorRepositoryInterface
{
    public function __construct(Master_motor $master_motor)
    {
        parent::__construct($master_motor);
    }
}
