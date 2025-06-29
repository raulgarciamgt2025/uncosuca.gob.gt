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
        Schema::table('users', function (Blueprint $table) {
            $table->string('signature_user')->nullable()->after('password');
            $table->string('signature_password')->nullable()->after('signature_user');
            $table->string('signature_image')->nullable()->after('signature_password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('signature_user');
            $table->dropColumn('signature_password');
            $table->dropColumn('signature_image');
        });
    }
};
