<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the old simple columns (table is a fresh, empty module).
        Schema::table('product_category_details', function (Blueprint $table) {
            $table->dropUnique('product_category_details_slug_unique');
        });
        Schema::table('product_category_details', function (Blueprint $table) {
            $table->dropColumn(['name', 'image', 'slug']);
        });

        // Add the full page-builder fields.
        Schema::table('product_category_details', function (Blueprint $table) {
            // Banner
            $table->string('banner_image')->nullable()->after('product_category_id');
            $table->text('banner_description')->nullable()->after('banner_image');
            // Intro section
            $table->string('section_heading')->nullable()->after('banner_description');
            $table->string('section_image')->nullable()->after('section_heading');
            $table->longText('section_description')->nullable()->after('section_image');
            // Product Range section
            $table->string('product_range_title')->nullable()->after('section_description');
            $table->string('product_range_heading')->nullable()->after('product_range_title');
            // Knowledge Spectrum section
            $table->string('knowledge_title')->nullable()->after('product_range_heading');
            $table->string('knowledge_heading')->nullable()->after('knowledge_title');
            $table->longText('knowledge_description')->nullable()->after('knowledge_heading');
            $table->string('knowledge_background_image')->nullable()->after('knowledge_description');
            // Industries section
            $table->string('industries_title')->nullable()->after('knowledge_background_image');
            $table->string('industries_heading')->nullable()->after('industries_title');
            // Media section
            $table->string('media_title')->nullable()->after('industries_heading');
            $table->string('media_heading')->nullable()->after('media_title');
            $table->longText('media_description')->nullable()->after('media_heading');
            $table->text('media_youtube_url')->nullable()->after('media_description');
        });
    }

    public function down(): void
    {
        Schema::table('product_category_details', function (Blueprint $table) {
            $table->dropColumn([
                'banner_image', 'banner_description',
                'section_heading', 'section_image', 'section_description',
                'product_range_title', 'product_range_heading',
                'knowledge_title', 'knowledge_heading', 'knowledge_description', 'knowledge_background_image',
                'industries_title', 'industries_heading',
                'media_title', 'media_heading', 'media_description', 'media_youtube_url',
            ]);
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
        });
    }
};
