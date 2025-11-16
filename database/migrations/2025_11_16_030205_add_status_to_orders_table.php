<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_status_to_orders_table_only.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'status')) {
                $table->enum('status', ['pending', 'confirmed', 'shipping', 'completed', 'cancelled'])
                      ->default('pending')
                      ->after('total');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};