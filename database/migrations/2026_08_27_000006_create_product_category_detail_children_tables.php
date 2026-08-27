<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Knowledge Spectrum → Features table (number + description).
        // Short, explicit FK names — the auto-generated names exceed MySQL's 64-char limit.
        Schema::create('product_category_detail_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_detail_id');
            $table->foreign('product_category_detail_id', 'pcd_feature_detail_fk')
                ->references('id')->on('product_category_details')->cascadeOnDelete();
            $table->string('number');
            $table->text('description');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Industries → Industries Served table (name only).
        Schema::create('product_category_detail_industries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_detail_id');
            $table->foreign('product_category_detail_id', 'pcd_industry_detail_fk')
                ->references('id')->on('product_category_details')->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_category_detail_industries');
        Schema::dropIfExists('product_category_detail_features');
    }
};
