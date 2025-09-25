<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 40; $i++) {
            DB::table('products')->insert([
                'proname' => "Sản phẩm $i",
                'price' => rand(500000, 1000000),
                'description' => "Mô tả $i",
                'cateid' => rand(1, 10),
                'brandid' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
                'fileName' => null, // nếu có cột này trong bảng
            ]);
        }
    }
}
