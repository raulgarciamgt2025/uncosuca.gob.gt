<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pays', function (Blueprint $table) {
            $table->string('ticket_file')->after('ticket_number');
            $table->longText('rejections')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pays', function (Blueprint $table) {
            $table->dropColumn('ticket_file');
            $table->dropColumn('rejections');
        });
    }
};
