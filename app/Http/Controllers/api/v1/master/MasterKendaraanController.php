<?php

namespace App\Http\Controllers\api\v1\master;

use App\Http\Controllers\api\v1\auth\dao\UserRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepository;
use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMobilRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMotorRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Master_kendaraan;
use Exception;
use Illuminate\Http\Request;

class MasterKendaraanController extends Controller
{
    protected $masterKendaraanRepository;
    protected $masterMobilRepository;
    protected $masterMotorRepository;
    public function __construct(MasterKendaraanRepositoryInterface $masterKendaraanRepository, MasterMobilRepositoryInterface $masterMobilRepository, MasterMotorRepositoryInterface $masterMotorRepository)
    {
        $this->masterKendaraanRepository = $masterKendaraanRepository;
        $this->masterMobilRepository = $masterMobilRepository;
        $this->masterMotorRepository = $masterMotorRepository;
    }
    public function index()
    {
        $data = $this->masterKendaraanRepository->all();
        return ApiResponse::success($data);
    }
    public function store(Request $request)
    {
        try {
            $kendaraan = [
                'year' => $request->year,
                'color' => $request->color,
                'price' => $request->price,
                'created_by' => '',
                'updated_by' => null,
                'is_active'=> true,
            ];
            $data['detail'] = [];

            $data = $this->masterKendaraanRepository->create($kendaraan);
            $vehicle_id = $data->_id;
            if ($request->type_vehicle == 'car'){

                $car = [
                    "vehicle_id" => $vehicle_id,
                    "machine" => $request->vehicle['machine'],
                    "passenger_capacity" =>$request->vehicle['passenger_capacity'],
                    "type" => $request->vehicle['type'],
                    'created_by' => '',
                    'updated_by' => null,
                    'is_active'=> true,
                ];

                $data_detail = $this->masterMobilRepository->create($car);
                $data['detail'] = $data_detail;
            }elseif ($request->type_vehicle == 'motorcycle'){
                $motorcycle = [
                    "vehicle_id" => $vehicle_id,
                    "machine" => $request->vehicle['machine'],
                    "suspension_type" =>$request->vehicle['suspension_type'],
                    "transmission_type" => $request->vehicle['transmission_type'],
                    'created_by' => '',
                    'updated_by' => null,
                    'is_active'=> true,
                ];

                $data_detail = $this->masterMotorRepository->create($motorcycle);
                $data['detail'] = $data_detail;
            }

            return response()->json(['message' => 'created successfully!', 'data' => $data]);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()]);

        }

    }

}
