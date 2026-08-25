<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_intros', function (Blueprint $table) {
            $table->id();
            $table->string('heading');                       // Intro heading
            $table->string('image')->nullable();             // Intro image (uploaded filename)
            $table->longText('introduction')->nullable();    // Introduction (rich text)
            $table->string('motto_heading')->nullable();     // Partner message — motto heading
            $table->longText('motto_description')->nullable(); // Partner message — description (rich text)
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_intros');
    }
};
