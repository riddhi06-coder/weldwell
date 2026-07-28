<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_stat_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_stat_id')->constrained('company_stats')->cascadeOnDelete();
            $table->string('stat_no');
            $table->string('stat_name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_stat_items');
    }
};
