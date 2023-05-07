<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Stock extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'stocks';
    protected $fillable = [
        'vehicle_id',
        'total_stock',
        'type',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
