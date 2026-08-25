<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_quality_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_quality_id')->constrained('about_qualities')->cascadeOnDelete();
            $table->string('value_name');                 // Core value name
            $table->longText('description')->nullable();   // Core value description (rich text)
            $table->unsignedInteger('sort_order')->default(0);
            $table->softDeletes();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_quality_values');
    }
};
