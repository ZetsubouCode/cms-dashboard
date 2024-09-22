<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_method';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
