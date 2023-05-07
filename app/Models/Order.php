<?php

namespace App\Models;

use App\Http\Controllers\api\v1\master\dao\MasterMotorRepositoryInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'orders';
    protected $fillable = [
        'order_number',
        'vehicle_id',
        'vehicle_type',
        'vehicle_price',
        'customers_name',
        'customers_address',
        'created_by',
        'updated_by',
        'is_active',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $lastOrder = DB::table('orders')->latest('id')->first();
            $lastOrderNumber = $lastOrder ? $lastOrder['order_number'] : null;
            $order->order_number = $order->generateOrderNumber($lastOrderNumber);
        });
    }

    public function generateOrderNumber($lastOrderNumber = null)
    {
        $prefix = date('Ymd');
        $lastNumber = $lastOrderNumber ? intval(substr($lastOrderNumber, -4)) : 0;
        $newNumber = $lastNumber + 1;
        $suffix = str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        return $prefix . $suffix;
    }
}
