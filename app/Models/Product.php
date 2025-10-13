<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'proname',
        'price',
        'brandid',
        'cateid',
        'description',
        'fileName',
        'stock_quantity', // 👈 Thêm dòng này
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandid', 'id');
    }

    public function getFileNameAttribute($value)
    {
        return $value;
    }
}