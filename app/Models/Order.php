<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

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


}
