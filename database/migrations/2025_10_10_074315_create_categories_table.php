<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            // Khóa chính (Primary Key) và Khóa ngoại (Foreign Key)
            // Đảm bảo tên cột là 'cateid' nếu bảng products đang tham chiếu tên này.
            $table->id('cateid');

            // Cột catename (mà migration thêm cột 'image' tham chiếu)
            $table->string('catename', 100);

            // Thêm các cột khác nếu bảng categories của bạn có.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};