<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSupply extends Model
{
    use HasFactory;

    protected $table = 'product_supply';

    protected $fillable = [
        'product_id',
        'supply_id',
        'quantity_used',
        'unit_of_measure',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
