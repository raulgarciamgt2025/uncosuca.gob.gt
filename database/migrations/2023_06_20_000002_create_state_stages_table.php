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
        Schema::create('state_stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workflow_request_id');
            $table->integer('state')->default(0);
            $table->integer('stage');
            $table->longText('json')->nullable();
            $table->text('description');
            $table->boolean('manager')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_stages');
    }
};
