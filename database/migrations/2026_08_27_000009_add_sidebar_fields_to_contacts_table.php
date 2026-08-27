<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('sidebar_company_name')->nullable()->after('address_heading');
            $table->text('sidebar_desc')->nullable()->after('sidebar_company_name');
            $table->string('sidebar_contact_no')->nullable()->after('sidebar_desc');
            $table->string('sidebar_email')->nullable()->after('sidebar_contact_no');
            $table->string('sidebar_website')->nullable()->after('sidebar_email');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'sidebar_company_name', 'sidebar_desc', 'sidebar_contact_no',
                'sidebar_email', 'sidebar_website',
            ]);
        });
    }
};
