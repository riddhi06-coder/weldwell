<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->text('website_intro')->nullable();    // rich text (editor)
            $table->text('website_address')->nullable();  // rich text (editor)
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->text('map_url')->nullable();
            $table->text('iframe_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
