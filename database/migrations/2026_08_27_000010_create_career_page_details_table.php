<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_page_details', function (Blueprint $table) {
            $table->id();
            $table->string('banner_heading')->nullable();
            $table->longText('description')->nullable();
            $table->string('section_heading')->nullable();
            $table->string('career_heading')->nullable();
            $table->string('title')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        // Benefits table (benefit + description).
        Schema::create('career_page_detail_benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('career_page_detail_id');
            $table->foreign('career_page_detail_id', 'cpd_benefit_detail_fk')
                ->references('id')->on('career_page_details')->cascadeOnDelete();
            $table->string('benefit');
            $table->text('description');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_page_detail_benefits');
        Schema::dropIfExists('career_page_details');
    }
};
