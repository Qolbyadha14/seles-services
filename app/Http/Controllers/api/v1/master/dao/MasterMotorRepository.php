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

    public function allWithRelation()
    {
        $models = $this->model->with('vehicle')->get();

        $data = [];

        foreach ($models as $model) {
            $vehicle = $model->vehicle;

            $data[] = $model->append([
                'year', 'color', 'price'
            ])->makeHidden('vehicle')->toArray();

            $data[count($data) - 1]['year'] = $vehicle->year;
            $data[count($data) - 1]['color'] = $vehicle->color;
            $data[count($data) - 1]['price'] = $vehicle->price;
        }

        return $data;
    }
}
