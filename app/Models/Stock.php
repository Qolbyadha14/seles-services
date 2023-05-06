<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Stock extends Eloquent
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'stock',
        'created_by',
        'updated_by',
        'status'
    ];
}
