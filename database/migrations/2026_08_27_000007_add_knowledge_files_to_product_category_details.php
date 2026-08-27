<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_category_details', function (Blueprint $table) {
            $table->string('knowledge_certificate')->nullable()->after('knowledge_background_image');
            $table->string('knowledge_brochure')->nullable()->after('knowledge_certificate');
            $table->text('knowledge_map_url')->nullable()->after('knowledge_brochure');
        });
    }

    public function down(): void
    {
        Schema::table('product_category_details', function (Blueprint $table) {
            $table->dropColumn(['knowledge_certificate', 'knowledge_brochure', 'knowledge_map_url']);
        });
    }
};
