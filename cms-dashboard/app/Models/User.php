<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Change this line
use Illuminate\Notifications\Notifiable; // Add this line
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable // Extend Authenticatable instead of Model
{
    use HasFactory, Notifiable; // Use both traits

    protected $table = 'user';
    public $timestamps = false;
    protected $hidden = [
        'password',
    ];
    protected $fillable = [
        'role_id',
        'name',
        'username',
        'email',
        'password',
        'address',
        'email_is_verified',
        'phone_is_verified',
        'phone_number',
        'profile_picture_url',
        'date_created',
        'date_updated',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
