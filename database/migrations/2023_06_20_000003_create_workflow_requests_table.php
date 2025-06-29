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
        Schema::create('workflow_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('process_type')->nullable()->comment('1: Individual, 2: Jurídico');
            $table->integer('state')->default(0);
            $table->json('status_log')->nullable();
            $table->json('final_result')->nullable();
            $table->unsignedBigInteger('request_user_id');
            $table->unsignedBigInteger('workflow_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_requests');
    }
};
