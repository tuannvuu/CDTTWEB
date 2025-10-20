<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('categories', 'cateimage')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('cateimage', 255)->nullable()->after('catename');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('categories', 'cateimage')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('cateimage');
            });
        }
    }
};