<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('state_stages', function (Blueprint $table) {
            $table
                ->foreign('workflow_request_id')
                ->references('id')
                ->on('workflow_requests');

            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('state_stages', function (Blueprint $table) {
            $table->dropForeign(['workflow_request_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['stage_id']);
        });
    }
};
