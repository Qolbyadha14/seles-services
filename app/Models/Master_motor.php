<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine',
        'suspension_type',
        'transmission_type',
        'created_by',
        'updated_by'.
        'is_active'
    ];
}
