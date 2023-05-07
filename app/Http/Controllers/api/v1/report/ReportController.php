<?php

namespace App\Http\Controllers\api\v1\report;

use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMobilRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMotorRepositoryInterface;
use App\Http\Controllers\api\v1\sales\dao\OrderRepositoryInterface;
use App\Http\Controllers\api\v1\sales\dao\StockRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $orderRepository;
    protected $stockRepository;
    protected $kendaraanRepository;
    protected $masterMobilRepository;
    protected $masterMotorRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        StockRepositoryInterface $stockRepository,
        MasterKendaraanRepositoryInterface $kendaraanRepository,
        MasterMobilRepositoryInterface $masterMobilRepository,
        MasterMotorRepositoryInterface $masterMotorRepository
    )
    {
        $this->masterMobilRepository = $masterMobilRepository;
        $this->masterMotorRepository = $masterMotorRepository;
        $this->orderRepository = $orderRepository;
        $this->stockRepository = $stockRepository;
        $this->kendaraanRepository = $kendaraanRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ReportStockVehicle(Request $request)
    {
        try {
            $listCar = $this->masterMobilRepository->allWithRelation();
            $listMotorcycle = $this->masterMotorRepository->allWithRelation();

            $totalStockCar = 0;
            $totalMotorcycle = 0;
            foreach ($listCar as $value){
                $totalStockCar += $value['stockAvailable'];
            }

            foreach ($listMotorcycle as $value){
                $totalMotorcycle += $value['stockAvailable'];
            }

            $data['car'] = [
                'list' => $listCar,
                'total_stock' => $totalStockCar
            ];

            $data['motor'] = [
                'list' => $listMotorcycle,
                'total_stock' => $totalMotorcycle
            ];

            return ApiResponse::success($data, "get data report stock successfully!");
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500, $e->getMessage());
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ReportAllSalesVehicle(Request $request){
        try {
            $listCar = $this->masterMobilRepository->allWithRelation();
            $listMotorcycle = $this->masterMotorRepository->allWithRelation();

            $countSalesCar = 0;
            $countSalesMotorcycle = 0;
            $sumSalesCar=0;
            $sumSalesMotorcycle=0;
            foreach ($listCar as $value){
                $countSalesCar += $value['totalSalesOrderCount'];
                $sumSalesCar += $value['totalSalesOrder'];

            }

            foreach ($listMotorcycle as $value){
                $countSalesMotorcycle += $value['totalSalesOrderCount'];
                $sumSalesMotorcycle += $value['totalSalesOrder'];

            }

            $data['car'] = [
                'list' => $listCar,
                'count_sales' => $countSalesCar,
                'total_sales' => $sumSalesCar,
            ];

            $data['motor'] = [
                'list' => $listMotorcycle,
                'count_sales' => $countSalesMotorcycle,
                'total_sales' => $sumSalesMotorcycle
            ];

            return ApiResponse::success($data, "get data report stock successfully!");
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500, $e->getMessage());
        }
    }

}
