<?php

namespace App\Http\Controllers\api\v1\sales;

use App\Exceptions\ValidationException;
use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepositoryInterface;
use App\Http\Controllers\api\v1\sales\dao\OrderRepositoryInterface;
use App\Http\Controllers\api\v1\sales\dao\StockRepositoryInterface;
use App\Http\Controllers\api\v1\sales\dto\OrderTransactionDto;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $stockRepository;
    protected $kendaraanRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, StockRepositoryInterface $stockRepository, MasterKendaraanRepositoryInterface $kendaraanRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->stockRepository = $stockRepository;
        $this->kendaraanRepository = $kendaraanRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request){
        try {
            $dto = new OrderTransactionDto($request->all());
            $user = JWTAuth::user();

            $order = [
                'vehicle_id'=> $dto->vehicle_id,
                'vehicle_type' => $dto->vehicle_type,
                'vehicle_price' => $dto->vehicle_price,
                'customers_name' => $dto->customers_name,
                'customers_address' => $dto->customers_address,
                'created_by' => $user->email,
                'updated_by' => null,
                'is_active'=> true,
                'status' => 'In Queue'
            ];
            $check_vehicle = $this->kendaraanRepository->find($dto->vehicle_id);

            if ($check_vehicle == null){
                return ApiResponse::error('vehicle not found');
            }

            $check_stock_in = $this->stockRepository->findBy(['vehicle_id'=>$dto->vehicle_id, 'type' => 'in', 'is_active' => true]);
            $check_stock_out = $this->stockRepository->findBy(['vehicle_id'=>$dto->vehicle_id, 'type' => 'out', 'is_active' => true]);
            $total_stock_in = 0;
            $total_stock_out = 0;

            foreach ($check_stock_in as $value){
                $total_stock_in += $value->total_stock;
            }
            foreach ($check_stock_out as $value){
                $total_stock_out += $value->total_stock;
            }
            $check_stock =$total_stock_in - $total_stock_out;

            if($check_stock <= 0){
                return ApiResponse::error('empty stock');
            }

            $stock = [
                'vehicle_id'=> $request->vehicle_id,
                'total_stock' => 1,
                'type' => 'out',
                'created_by' => '',
                'updated_by' => null,
                'is_active'=> true
            ];

            $this->stockRepository->create($stock);
            $data = $this->orderRepository->create($order);
            return ApiResponse::success($data, "created successfully!");
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), $e->getCode(), $e->errors);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500, $e->getMessage());
        }
    }
}
