<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brand_categories', function (Blueprint $table) {
            $table->dropColumn(['show_in_brand_header', 'show_in_product_header']);
        });
    }

    public function down(): void
    {
        Schema::table('brand_categories', function (Blueprint $table) {
            $table->boolean('show_in_brand_header')->default(false)->after('is_active');
            $table->boolean('show_in_product_header')->default(false)->after('show_in_brand_header');
        });
    }
};
