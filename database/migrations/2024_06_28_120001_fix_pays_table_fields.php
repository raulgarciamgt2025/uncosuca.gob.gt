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
            // Check if columns exist before adding them
            if (!Schema::hasColumn('pays', 'estado')) {
                $table->enum('estado', ['CUOTA', 'INSCRIPCION'])->default('CUOTA')->after('company_id');
            }
            if (!Schema::hasColumn('pays', 'fecha_pago')) {
                $table->date('fecha_pago')->nullable()->after('estado');
            }
            if (!Schema::hasColumn('pays', 'observaciones')) {
                $table->text('observaciones')->nullable()->after('fecha_pago');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pays', function (Blueprint $table) {
            if (Schema::hasColumn('pays', 'estado')) {
                $table->dropColumn('estado');
            }
            if (Schema::hasColumn('pays', 'fecha_pago')) {
                $table->dropColumn('fecha_pago');
            }
            if (Schema::hasColumn('pays', 'observaciones')) {
                $table->dropColumn('observaciones');
            }
        });
    }
};
