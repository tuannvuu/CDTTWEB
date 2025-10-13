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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Khóa chính của bảng products (unsignedBigInteger)
            $table->string('proname', 100);
            $table->integer('price');
            $table->string('description', 300)->nullable();

            // 🚨 ĐÃ SỬA: Dùng unsignedBigInteger để khớp với $table->id() trong bảng categories.
            $table->unsignedBigInteger('cateid');

            $table->string('fileName', 255)->nullable();
            $table->timestamps();

            // Khóa ngoại: Tham chiếu cột 'cateid' trên bảng 'categories'.
            // Cả hai cột đều là unsignedBigInteger, khắc phục lỗi 3780.
            $table->foreign('cateid', 'categories_cateid_foreign')
                ->references('cateid')->on('categories');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
