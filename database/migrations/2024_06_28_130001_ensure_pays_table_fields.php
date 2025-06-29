<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw SQL to add columns if they don't exist
        $columns = DB::select("SHOW COLUMNS FROM pays LIKE 'estado'");
        if (empty($columns)) {
            DB::statement("ALTER TABLE pays ADD COLUMN estado ENUM('CUOTA', 'INSCRIPCION') DEFAULT 'CUOTA' AFTER company_id");
        }
        
        $columns = DB::select("SHOW COLUMNS FROM pays LIKE 'fecha_pago'");
        if (empty($columns)) {
            DB::statement("ALTER TABLE pays ADD COLUMN fecha_pago DATE NULL AFTER estado");
        }
        
        $columns = DB::select("SHOW COLUMNS FROM pays LIKE 'observaciones'");
        if (empty($columns)) {
            DB::statement("ALTER TABLE pays ADD COLUMN observaciones TEXT NULL AFTER fecha_pago");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columns = DB::select("SHOW COLUMNS FROM pays LIKE 'estado'");
        if (!empty($columns)) {
            DB::statement("ALTER TABLE pays DROP COLUMN estado");
        }
        
        $columns = DB::select("SHOW COLUMNS FROM pays LIKE 'fecha_pago'");
        if (!empty($columns)) {
            DB::statement("ALTER TABLE pays DROP COLUMN fecha_pago");
        }
        
        $columns = DB::select("SHOW COLUMNS FROM pays LIKE 'observaciones'");
        if (!empty($columns)) {
            DB::statement("ALTER TABLE pays DROP COLUMN observaciones");
        }
    }
};
