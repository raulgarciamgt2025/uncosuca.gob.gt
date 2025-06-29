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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mercantile_name')->nullable();
            $table->string('social_denomination')->nullable();
            $table->string('nit')->nullable();
            $table->text('address')->nullable();
            $table->string('village')->nullable();
            $table->text('station_address')->nullable();
            $table->text('coverage')->nullable();
            $table->text('owners')->nullable();
            $table->string('legal_representative')->nullable();
            $table->string('cui')->nullable();
            $table->string('phone')->nullable();
            $table->integer('users_number')->nullable();
            $table->string('license')->nullable();
            $table->string('resolution')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('status')->default(0);
            $table->integer('payment_status')->default(0);
            $table->integer('company_type')->nullable()->comment('1: Individual, 2: Jurídico');
            $table->json('workflows_history')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
