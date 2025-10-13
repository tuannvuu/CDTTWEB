<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('brands')->insert([
                // Xóa 'id' => $i, để MySQL tự động gán ID
                'brandname' => "Thương hiệu $i",
                'description' => "Mô tả $i"
            ]);
        }
    }
}
