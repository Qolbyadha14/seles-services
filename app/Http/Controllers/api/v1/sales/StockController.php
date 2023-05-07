<?php

namespace App\Http\Controllers\api\v1\sales;

use App\Exceptions\ValidationException;
use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepositoryInterface;
use App\Http\Controllers\api\v1\sales\dao\StockRepositoryInterface;
use App\Http\Controllers\api\v1\sales\dto\StockCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class StockController extends Controller
{
    protected $kendaraanRepository;
    protected $stockRepository;

    public function __construct(MasterKendaraanRepositoryInterface $kendaraanRepository, StockRepositoryInterface $stockRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request){
        try {
            $user = JWTAuth::user();

            $dto = new StockCreateDto($request->all());
            $check_vehicle = $this->kendaraanRepository->find($dto->vehicle_id);

            if ($check_vehicle == null){
                return ApiResponse::error('vehicle not found');
            }

            $stock = [
                'vehicle_id'=> $dto->vehicle_id,
                'total_stock' => $dto->total_stock,
                'type' => 'in',
                'created_by' => $user->email,
                'updated_by' => null,
                'is_active'=> true
            ];
            $data = $this->stockRepository->create($stock);
            return ApiResponse::success($data, "created successfully!");


        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), $e->getCode(), $e->errors);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500, $e->getMessage());
        }
    }
}
