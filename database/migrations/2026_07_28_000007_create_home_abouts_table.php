<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_abouts', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('title')->nullable();          // rich text (editor)
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->text('small_intro')->nullable();     // rich text (editor)
            $table->longText('description')->nullable();  // rich text (editor)
            $table->string('experience_title')->nullable();
            $table->string('experience')->nullable();     // number with optional "+", e.g. "25+"
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_abouts');
    }
};
