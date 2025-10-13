<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customerid',
        'description',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerid', 'id');
    }

    public function items()
    {
        return $this->hasMany(Orderitem::class, 'orderid', 'id');
    }
}