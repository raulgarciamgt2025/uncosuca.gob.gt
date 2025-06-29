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
        Schema::create('pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mount')->default(date('m'));
            $table->string('year')->default(date('Y'));
            $table->float('pay')->default(0);
            $table->float('amount')->default(0);
            $table->float('variable')->default(0);
            $table->float('penalty')->default(0);
            $table->string('ticket_number')->nullable();
            $table->string('subscribers_number')->default(0);
            $table->string('status')->default(0)->comment('0: Pendiente, 1: Cargado, 2: Verificado, 3: Rechazado');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
