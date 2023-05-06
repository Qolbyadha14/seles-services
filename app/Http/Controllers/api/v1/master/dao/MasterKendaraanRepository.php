<?php

namespace App\Http\Controllers\api\v1\master\dao;

use App\Http\BaseRepositories\BaseRepository;
use App\Models\Master_kendaraan;

class MasterKendaraanRepository extends BaseRepository implements MasterKendaraanRepositoryInterface
{
    public function __construct(Master_kendaraan $master_kendaraan)
    {
        parent::__construct($master_kendaraan);
    }
}
