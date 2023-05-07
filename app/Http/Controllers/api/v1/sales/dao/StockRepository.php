<?php

namespace App\Http\Controllers\api\v1\sales\dao;

use App\Http\BaseRepositories\BaseRepository;
use App\Models\Order;
use App\Models\Stock;

class StockRepository extends BaseRepository implements StockRepositoryInterface
{
    public function __construct(Stock $stock)
    {
        parent::__construct($stock);
    }
}
