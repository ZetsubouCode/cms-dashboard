<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discount';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'discount_type',
        'discount_value',
        'quota',
        'remaining_quota',
        'start_date',
        'end_date',
        'status',
        'date_created',
        'date_updated'
    ];
}
