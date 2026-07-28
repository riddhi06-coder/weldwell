<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_knowledge_spectrums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('heading')->nullable();          // rich text (editor)
            $table->string('background_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_knowledge_spectrums');
    }
};
