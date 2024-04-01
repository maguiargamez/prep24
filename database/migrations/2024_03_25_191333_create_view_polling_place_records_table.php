<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return "
            CREATE VIEW view_polling_place_records 
                AS

                SELECT
                    c_casillas.id, 
                    records.id as prep_polling_place_records_id,
                    c_casillas.id_municipio as municipality_key,
                    c_municipio.municipio as municipality,
                    CONCAT('Distrito ', c_casillas.dtto_loc) as district,
                    c_casillas.dtto_loc as local_district_key,
                    c_casillas.seccion as section,
                    c_casillas.casilla as type,
                    c_casillas.tipo_casilla as type_key,
                    records.digitized_record,
                    IFNULL(records.is_captured, 0 ) as is_captured,
                    IFNULL(records.is_validated, 0 ) as is_validated,
                    records.updated_at,
                    records.capture_source
                FROM c_casillas

                LEFT JOIN prep_polling_place_records as records ON records.c_casilla_id= c_casillas.id
                LEFT JOIN c_municipio ON c_municipio.id= c_casillas.id_municipio

                ORDER BY c_casillas.id DESC                
            ";
    }

    private function dropView(): string
    {
        return "
            DROP VIEW IF EXISTS `view_eco_clients`;
            ";
    }
};
