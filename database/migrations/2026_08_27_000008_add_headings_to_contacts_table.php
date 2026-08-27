<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('heading')->nullable()->after('id');
            $table->text('intro_message')->nullable()->after('heading');
            $table->string('address_heading')->nullable()->after('intro_message');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['heading', 'intro_message', 'address_heading']);
        });
    }
};
