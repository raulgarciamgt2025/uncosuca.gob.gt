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
        Schema::table('workflow_requests', function (Blueprint $table) {
            $table
                ->foreign('request_user_id')
                ->references('id')
                ->on('users');

            $table
                ->foreign('workflow_id')
                ->references('id')
                ->on('workflows');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workflow_requests', function (Blueprint $table) {
            $table->dropForeign(['request_user_id']);
            $table->dropForeign(['workflow_id']);
        });
    }
};
