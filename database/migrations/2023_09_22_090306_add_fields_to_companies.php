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
        Schema::table('companies', function (Blueprint $table) {
            $table->json('emails')->nullable()->after('resolution');
            $table->decimal('latitude', '10', '7')->nullable()->after('resolution');
            $table->decimal('longitude', '10', '7')->nullable()->after('resolution');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('emails');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};
