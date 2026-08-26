<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // main_categories -> brand_categories, sub_categories -> brand_lists.
        // MySQL updates dependent foreign keys automatically on RENAME TABLE.
        if (Schema::hasTable('main_categories') && ! Schema::hasTable('brand_categories')) {
            Schema::rename('main_categories', 'brand_categories');
        }
        if (Schema::hasTable('sub_categories') && ! Schema::hasTable('brand_lists')) {
            Schema::rename('sub_categories', 'brand_lists');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('brand_lists') && ! Schema::hasTable('sub_categories')) {
            Schema::rename('brand_lists', 'sub_categories');
        }
        if (Schema::hasTable('brand_categories') && ! Schema::hasTable('main_categories')) {
            Schema::rename('brand_categories', 'main_categories');
        }
    }
};
