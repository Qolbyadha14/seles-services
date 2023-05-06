<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_motor extends Master_kendaraan
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'master_motors';
    protected $fillable = [
        'vehicle_id',
        'machine',
        'suspension_type',
        'transmission_type',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
