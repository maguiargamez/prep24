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
        $procedure = "
            DROP PROCEDURE IF EXISTS get_candidates_votes_by_distrito;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `get_candidates_votes_by_distrito`(IN election_id int, IN municipality_id int, IN district int)
            BEGIN
                DECLARE filterElection varchar(100);
                DECLARE filterMunicipality varchar(100); 
                DECLARE filterDistrict varchar(100);  
                
                SET @sql = NULL;  
                SET filterDistrict = \"\";
                SET filterMunicipality = \"\";
                SET filterElection = \"where 1=1 \";
                
                IF !ISNULL(election_id) THEN
                    SET filterElection = CONCAT('where c_casillas.prep_election_id=', election_id, ' ');
                END IF;
                
                IF !ISNULL(municipality_id) THEN
                    SET filterMunicipality = CONCAT('and c_casillas.id_municipio=', municipality_id, ' ');
                END IF;
                
                IF !ISNULL(district) THEN
                    SET filterDistrict = CONCAT('and CONVERT(c_casillas.dtto_loc,UNSIGNED INTEGER)=\"', district, '\" ');
                END IF;
                
                SELECT
                GROUP_CONCAT(DISTINCT
                    CONCAT(
                    'sum(
                        case when prep_candidates.name = ''',  name, ''' then votes end
                    ) AS ',
                    replace(replace(name, ' ', '_'), '-', '_')
                    )
                    order by ordered asc
                )   
                INTO @sql
                from prep_candidates
                ;
                
                    SET @sql = CONCAT(
                '
                SELECT c_casillas.id, 
                    prep_polling_place_records.id as prep_polling_place_record_id, 
                    prep_polling_place_records.digitized_record as record, 
                    c_casillas.id_municipio, 
                    c_municipio.municipio, 
                    c_casillas.dtto_loc as distrito, c_casillas.seccion, 
                    CONCAT_WS(\" \", c_casillas.seccion, c_casillas.tipo_casilla) as casilla,  
                    ', @sql, ',
                    sum(votes) as total
                    from c_casillas
                        join c_municipio on c_municipio.id= c_casillas.id_municipio
                        left join prep_polling_place_records on c_casillas.id = prep_polling_place_records.c_casilla_id
                        left join prep_polling_place_votes on prep_polling_place_records.id = prep_polling_place_votes.prep_polling_place_record_id
                        left join prep_party_coalitions on prep_party_coalitions.id = prep_polling_place_votes.prep_party_coalition_id            
                        left join prep_candidate_party_coalitions on prep_party_coalitions.id = prep_candidate_party_coalitions.prep_party_coalition_id  
                        left join prep_candidates on prep_candidates.id = prep_candidate_party_coalitions.prep_candidate_id  
                        ', filterElection,' ', filterMunicipality,' ', filterDistrict, '
                    group by c_casillas.dtto_loc order by c_municipio.dtto_loc asc
                ');
                PREPARE stmt FROM @sql;
                EXECUTE stmt;
                DEALLOCATE PREPARE stmt;
            END
        ";

        DB::unprepared($procedure);
    }

};
