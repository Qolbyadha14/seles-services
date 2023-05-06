<?php

namespace App\Http\Controllers\api\v1\master\dao;

use App\Http\BaseRepositories\BaseRepository;
use App\Http\Controllers\api\v1\auth\dao\UserRepositoryInterface;
use App\Models\Master_kendaraan;
use App\Models\Master_mobil;

class MasterMobilRepository extends BaseRepository implements MasterMobilRepositoryInterface
{
    public function __construct(Master_mobil $master_mobil)
    {
        parent::__construct($master_mobil);
    }
}
