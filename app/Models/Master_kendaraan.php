<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'color',
        'price',
        'created_by',
        'updated_by'.
        'is_active'
    ];
}
