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
        Schema::table('visits', function (Blueprint $table) {
            $table->dateTime('filling_date')->nullable();
            $table->dateTime('acceptance_date')->nullable();
            $table->longText('history')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn('filling_date');
            $table->dropColumn('acceptance_date');
            $table->dropColumn('history');
        });
    }
};
