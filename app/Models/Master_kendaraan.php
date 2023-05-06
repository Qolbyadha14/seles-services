<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Master_kendaraan extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'master_kendaraans';
    protected $guarded = [];
    protected $fillable = [
        'year',
        'color',
        'price',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
