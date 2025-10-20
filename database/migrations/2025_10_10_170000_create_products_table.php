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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('proname', 100);
                $table->integer('price');
                $table->string('description', 300)->nullable();
                $table->unsignedBigInteger('cateid');
                $table->string('fileName', 255)->nullable();
                $table->timestamps();

                $table->foreign('cateid')
                    ->references('cateid')
                    ->on('categories')
                    ->onDelete('cascade');
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};