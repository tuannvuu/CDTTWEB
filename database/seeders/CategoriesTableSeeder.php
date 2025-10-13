<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('categories')->insert([
                // Đã xóa 'cateid' => $i, để MySQL tự động gán ID
                'catename' => "Danh mục $i",
                'description' => "Mô tả $i"
            ]);
        }
    }
}
