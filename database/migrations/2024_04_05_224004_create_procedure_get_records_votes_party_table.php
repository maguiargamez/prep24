<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $procedure = "
        DROP PROCEDURE IF EXISTS get_records_votes_party;
        CREATE DEFINER=root@localhost PROCEDURE get_records_votes_party(IN distrito VARCHAR(100), IN seccion VARCHAR(100))
        BEGIN
            DECLARE filterDistrito varchar(50);
            DECLARE filterSeccion varchar(50);
            SET @sql = NULL;
            
            SET filterDistrito = '';
            SET filterSeccion = 'where 1=1 ';
            
            SELECT
              GROUP_CONCAT(DISTINCT
                CONCAT(
                  'sum(case when name = ''',  name, ''' then votes end) AS ',
                  replace(replace(name, ' ', '_'), '-', '_')
                )
              ) INTO @sql
            from prep_party_coalitions;
        
            IF !ISNULL(seccion) THEN
                SET filterSeccion = CONCAT('where c_casillas.seccion=\"', seccion, '\"');
            END IF;
            
            IF !ISNULL(distrito) THEN
                SET filterDistrito = CONCAT('and c_casillas.dtto_loc=\"', distrito, '\"');
            END IF;
            
            
            SET @sql = CONCAT(
            '
            SELECT c_casillas.id, 
                prep_polling_place_records.id as prep_polling_place_record_id, 
                prep_polling_place_records.digitized_record as record, 
                c_casillas.dtto_loc as distrito, c_casillas.seccion, 
                CONCAT_WS(\" \", c_casillas.seccion, c_casillas.tipo_casilla) as casilla,  
                ', @sql, ' 
                from c_casillas
                    left join prep_polling_place_records on c_casillas.id = prep_polling_place_records.c_casilla_id
                    left join prep_polling_place_votes on prep_polling_place_records.id = prep_polling_place_votes.prep_polling_place_record_id
                    left join prep_party_coalitions on prep_party_coalitions.id = prep_polling_place_votes.prep_party_coalition_id
                    ', filterSeccion,'', filterDistrito,'
            group by c_casillas.id,  prep_polling_place_records.id    
            ');
            PREPARE stmt FROM @sql;
            EXECUTE stmt;
            DEALLOCATE PREPARE stmt;
        END
        ";

        DB::unprepared($procedure);
    }
};
