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

    protected $appends = ['year', 'color', 'price','stockIn','stockOut','stockAvailable', 'totalSalesOrderCount','totalSalesOrder'];

    public function vehicle()
    {
        return $this->belongsTo(Master_kendaraan::class,'vehicle_id');
    }


    public function getYearAttribute()
    {
        return $this->vehicle->year;
    }

    public function getColorAttribute()
    {
        return $this->vehicle->color;
    }

    public function getPriceAttribute()
    {
        return $this->vehicle->price;
    }

    public function getStockInAttribute()
    {
        return Stock::where('vehicle_id', $this->vehicle_id)
            ->where('type', 'in')
            ->sum('total_stock');
    }

    public function getStockOutAttribute()
    {
        return Stock::where('vehicle_id', $this->vehicle_id)
            ->where('type', 'out')
            ->sum('total_stock');
    }

    public function getStockAvailableAttribute()
    {
        return $this->getStockInAttribute() - $this->getStockOutAttribute();
    }

    public function getTotalSalesOrderCountAttribute(){
        return Order::where('vehicle_id', $this->vehicle_id)->where('status','!=','Cancel')->count();
    }

    public function getTotalSalesOrderAttribute()
    {
        return Order::where('vehicle_id', $this->vehicle_id)->where('status','!=','Cancel')->sum('vehicle_price');
    }
}
