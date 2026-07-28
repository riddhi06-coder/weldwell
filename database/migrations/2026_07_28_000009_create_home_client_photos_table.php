<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_client_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_client_id')->constrained('home_clients')->cascadeOnDelete();
            $table->string('photo');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_client_photos');
    }
};
