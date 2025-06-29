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
            $table->string('estado')->nullable()->after('company_id');
            $table->date('fecha_pago')->nullable()->after('estado');
            $table->text('observaciones')->nullable()->after('fecha_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pays', function (Blueprint $table) {
            $table->dropColumn(['estado', 'fecha_pago', 'observaciones']);
        });
    }
};
