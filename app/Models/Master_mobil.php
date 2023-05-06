<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_mobil extends Master_kendaraan
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'master_mobils';
    protected $fillable = [
        'vehicle_id',
        'machine',
        'passenger_capacity',
        'type',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
