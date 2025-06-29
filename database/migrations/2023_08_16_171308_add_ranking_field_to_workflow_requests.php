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
            $table->json('ranking')->nullable()->after('final_result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workflow_requests', function (Blueprint $table) {
            $table->dropColumn('ranking');
        });
    }
};
