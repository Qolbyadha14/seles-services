<?php

namespace App\Http\Controllers\api\v1\master;

use App\Exceptions\ValidationException;
use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMobilRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMotorRepositoryInterface;
use App\Http\Controllers\api\v1\master\dto\MasterKendaraanCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            $dto = new MasterKendaraanCreateDto($request->all());
            $user = JWTAuth::user();
            $kendaraan = [
                'year' => $dto->year,
                'color' => $dto->color,
                'price' => $dto->price,
                'created_by' => '',
                'updated_by' => null,
                'is_active' => true,
            ];
            $data['detail'] = [];

            $data = $this->masterKendaraanRepository->create($kendaraan);
            $vehicle_id = $data->_id;
            if ($dto->type_vehicle == 'car') {

                $car = [
                    "vehicle_id" => $vehicle_id,
                    "machine" => $dto->vehicle['machine'],
                    "passenger_capacity" => $dto->vehicle['passenger_capacity'],
                    "type" => $dto->vehicle['type'],
                    'created_by' => $user->email,
                    'updated_by' => null,
                    'is_active' => true,
                ];

                $data_detail = $this->masterMobilRepository->create($car);
                $data['detail'] = $data_detail;
            } elseif ($dto->type_vehicle == 'motorcycle') {
                $motorcycle = [
                    "vehicle_id" => $vehicle_id,
                    "machine" => $dto->vehicle['machine'],
                    "suspension_type" => $dto->vehicle['suspension_type'],
                    "transmission_type" => $dto->vehicle['transmission_type'],
                    'created_by' => $user->email,
                    'updated_by' => null,
                    'is_active' => true,
                ];

                $data_detail = $this->masterMotorRepository->create($motorcycle);
                $data['detail'] = $data_detail;
            }
            return ApiResponse::success($data, "created successfully!");
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), $e->getCode(), $e->errors);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500, $e->getMessage());
        }

    }

}
