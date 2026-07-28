<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_intro_qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_intro_id')->constrained('product_intros')->cascadeOnDelete();
            $table->string('quality');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_intro_qualities');
    }
};
