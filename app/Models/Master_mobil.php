<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_mobil extends Master_kendaraan
{
    use HasFactory;
    protected $fillable = [
        'machine',
        'passenger_capacity',
        'type',
        'created_by',
        'updated_by'.
        'is_active'
    ];
}
