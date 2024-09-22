<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $table = 'supply';

    protected $fillable = [
        'name',
        'price_per_unit',
        'date_aquired',
        'description',
        'unit_of_measurement',
        'quantity',
        'location',
        'supplier_name',
        'status',
        'low_stock_percentage',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_supply');
    }
}
