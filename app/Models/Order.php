<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User; // <-- QUAN TRỌNG: Phải import User Model

class Order extends Model
{
    /**
     * Các thuộc tính có thể gán hàng loạt (Mass Assignable).
     * Đây là phiên bản ĐÚNG, khớp với Controller và View.
     */
    protected $fillable = [
        'customerid',
        'fullname',         // <-- Phải là 'fullname'
        'tel',              // <-- Phải là 'tel'
        'address',          // <-- Phải là 'address'
        'description',
        'payment_method',
        'total',
        'status',           // <-- Phải có 'status'
        'orderdate',        // <-- Phải có 'orderdate'
    ];

    /**
     * Quan hệ 1-n: Đơn hàng thuộc về 1 Khách hàng (User).
     */
    public function customer(): BelongsTo
    {
        // Giả định Model Customer của bạn là User
        return $this->belongsTo(User::class, 'customerid', 'id');
    }

    /**
     * Quan hệ 1-n: Đơn hàng có nhiều Chi tiết đơn hàng (Order Items).
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'orderid', 'id');
    }
}