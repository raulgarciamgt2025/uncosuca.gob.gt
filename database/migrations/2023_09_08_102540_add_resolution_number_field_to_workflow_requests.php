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
        Schema::table('workflow_requests', function (Blueprint $table) {
            $table->dropColumn('final_result');
            $table->dropColumn('status_log');
            $table->string('resolution_number')->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workflow_requests', function (Blueprint $table) {
            $table->dropColumn('resolution_number');
        });
    }
};
