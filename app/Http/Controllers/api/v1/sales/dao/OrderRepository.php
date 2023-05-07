<?php

namespace App\Http\Controllers\api\v1\sales\dao;

use App\Http\BaseRepositories\BaseRepository;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }


}
