<?php

namespace Database\Seeders;

use App\Models\PrepCandidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrepCandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        PrepCandidate::insert([
            [                
                'prep_election_id'=> 1,
                'prep_party_coalition_id'=> 2,
                'name' => 'Oscar Eduardo Ramírez Aguilar',
                'photo' => 'img/candidatos/oscar_eduardo_ramirez_aguilar.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'name' => 'Karla Irasema Muñoz Balanzar',
                'prep_party_coalition_id'=> 1,
                'photo' => 'img/candidatos/karla_irasema_munoz_balanzar.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'name' => 'Olga Luz Espinosa Morales',
                'prep_party_coalition_id'=> 6,
                'photo' => 'img/candidatos/olga_luz_espinosa_morales.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'name' => 'Candidaturas no registradas',
                'prep_party_coalition_id'=> 10,
                'photo' => null,
                'is_special'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'name' => 'Votos nulos',
                'prep_party_coalition_id'=> 11,
                'photo' => null,
                'is_special'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]
        ]);
    }
}
