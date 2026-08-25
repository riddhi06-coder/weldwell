<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_qualities', function (Blueprint $table) {
            $table->id();
            // Header block
            $table->longText('heading')->nullable();          // Heading (rich text)
            $table->string('image')->nullable();              // Header image (uploaded filename)
            // More Info block
            $table->string('background_image')->nullable();   // More Info — background image
            $table->longText('more_info_desc')->nullable();   // More Info — description (rich text)
            $table->string('youtube_link')->nullable();       // More Info — YouTube video link
            $table->text('statement')->nullable();            // More Info — statement
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_qualities');
    }
};
