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
            DROP PROCEDURE IF EXISTS get_candidates_votes_by_general;
            CREATE DEFINER=`root`@`localhost` PROCEDURE `get_candidates_votes_by_general`(IN election_id int, IN municipality_id int, IN district int, IN section int)
            BEGIN
                DECLARE filterElection varchar(100);
                DECLARE filterMunicipality varchar(100); 
                DECLARE filterDistrict varchar(100);  
                DECLARE filterSection varchar(100);  
                
                SET group_concat_max_len = 18446744073709551615;
                SET @sql = NULL;    
                SET filterSection = \"\";
                SET filterDistrict = \"\";
                SET filterMunicipality = \"\";
                SET filterElection = \"where 1=1 \";
                
                IF !ISNULL(election_id) THEN
                    SET filterElection = CONCAT('where prep_polling_place_votes.prep_election_id=\"', election_id, '\"');
                END IF;
                
                IF !ISNULL(municipality_id) THEN
                    SET filterMunicipality = CONCAT('and c_casillas.id_municipio=', municipality_id, ' ');
                END IF;
                
                IF !ISNULL(district) THEN
                    SET filterDistrict = CONCAT('and CONVERT(c_casillas.dtto_loc,UNSIGNED INTEGER)=\"', district, '\" ');
                END IF;
                
                IF !ISNULL(section) THEN
                    SET filterSection = CONCAT('and CONVERT(c_casillas.seccion,UNSIGNED INTEGER)=\"', section, '\" ');
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
                
                SET @sql = CONCAT(	'
                    SELECT prep_polling_place_votes.prep_election_id,
                    ', @sql, ',
                    sum(votes) as total
                    from prep_polling_place_votes
                        left join prep_polling_place_records on prep_polling_place_records.id = prep_polling_place_votes.prep_polling_place_record_id
                        left join c_casillas on c_casillas.id = prep_polling_place_records.c_casilla_id
                        left join prep_party_coalitions on prep_party_coalitions.id = prep_polling_place_votes.prep_party_coalition_id            
                        left join prep_candidate_party_coalitions on prep_party_coalitions.id = prep_candidate_party_coalitions.prep_party_coalition_id  
                        left join prep_candidates on prep_candidates.id = prep_candidate_party_coalitions.prep_candidate_id  
                    ', filterElection,' ', filterMunicipality,' ', filterDistrict,' ', filterSection, '
                    group by prep_polling_place_votes.prep_election_id
                ');
                
                PREPARE stmt FROM @sql;
                EXECUTE stmt;
                DEALLOCATE PREPARE stmt;
            END
        ";

        DB::unprepared($procedure);
    }

};
