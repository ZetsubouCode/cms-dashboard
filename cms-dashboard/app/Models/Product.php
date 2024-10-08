<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'quantity',
        'price',
        'image_url',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function supply()
    {
        return $this->belongsToMany(Supply::class, 'product_supply');
    }
}
