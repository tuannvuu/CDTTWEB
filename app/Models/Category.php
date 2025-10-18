<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = "cateid";
    protected $attributes = [
        'description' => 'Chưa có mô tả'
    ];
    // Thêm 'cateimage' vào đây
    protected $fillable = ['catename', 'description', 'cateimage'];

    public function products()
    {
        return $this->hasMany(Product::class, 'cateid', 'cateid');
    }
    public function getRouteKeyName()
{
    return 'cateid';
}

}