<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_intro_visions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_intro_id')->constrained('about_intros')->cascadeOnDelete();
            $table->string('heading');                    // Vision / Mission heading
            $table->longText('description')->nullable();  // Vision / Mission description (rich text)
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_intro_visions');
    }
};
