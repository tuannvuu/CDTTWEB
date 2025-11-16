<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Danh sách các cột có thể gán giá trị hàng loạt
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'fullname',
        'role',
    ];

    /**
     * Danh sách các cột bị ẩn khi xuất ra mảng hoặc JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kiểu dữ liệu của các cột
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customerid', 'id');
    }
  // app/Models/User.php - thêm các relationships
public function shippingAddresses()
{
    return $this->hasMany(ShippingAddress::class);
}

public function defaultAddress()
{
    return $this->hasOne(ShippingAddress::class)->where('is_default', true);
}
}