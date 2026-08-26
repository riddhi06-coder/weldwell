<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_customer_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_customer_id')->constrained('about_customers')->cascadeOnDelete();
            $table->string('feature_name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->softDeletes();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_customer_features');
    }
};
