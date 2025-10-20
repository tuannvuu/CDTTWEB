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
        // ✅ Chỉ tạo bảng nếu chưa tồn tại
        if (!Schema::hasTable('orderitems')) {
            Schema::create('orderitems', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('orderid');
                $table->unsignedBigInteger('productid');
                $table->integer('quantity');
                $table->decimal('price', 10, 2)->default(0);
                $table->timestamps();

                // ✅ Khóa ngoại: đảm bảo an toàn nếu bảng orders/products có thể chưa tồn tại
                $table->foreign('productid')
                    ->references('id')->on('products')
                    ->onDelete('cascade');

                $table->foreign('orderid')
                    ->references('id')->on('orders')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ✅ Chỉ xóa nếu tồn tại
        if (Schema::hasTable('orderitems')) {
            Schema::dropIfExists('orderitems');
        }
    }
};