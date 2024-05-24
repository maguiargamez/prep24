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
            // [                
            //     'prep_election_id'=> 1,
            //     'prep_party_coalition_id'=> 1,
            //     'ordered'=>1,
            //     'name' => 'Oscar Eduardo Ramírez Aguilar',
            //     'photo' => 'img/candidatos/oscar_eduardo_ramirez_aguilar.jpg',
            //     'is_special'=> false,
            //     'created_at' => $currentDate,
            //     'updated_at' => $currentDate,
            // ],
            // [
            //     'prep_election_id'=> 1,
            //     'ordered'=>3,
            //     'name' => 'Karla Irasema Muñoz Balanzar',
            //     'prep_party_coalition_id'=> 2,
            //     'photo' => 'img/candidatos/karla_irasema_munoz_balanzar.jpg',
            //     'is_special'=> false,
            //     'created_at' => $currentDate,
            //     'updated_at' => $currentDate,
            // ],
            // [
            //     'prep_election_id'=> 1,
            //     'ordered'=>2,
            //     'name' => 'Olga Luz Espinosa Morales',
            //     'prep_party_coalition_id'=> 6,
            //     'photo' => 'img/candidatos/olga_luz_espinosa_morales.jpg',
            //     'is_special'=> false,
            //     'created_at' => $currentDate,
            //     'updated_at' => $currentDate,
            // ],
            [
                'prep_election_id'=> 1,
                'ordered'=>1,
                'name' => 'Milred Citlaly Alvarez Domínguez',
                'prep_party_coalition_id'=> 1,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>2,
                'name' => 'Martin Arturo Aquino Palacios',
                'prep_party_coalition_id'=> 2,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>3,
                'name' => 'Ana Bertha Domínguez Palacios',
                'prep_party_coalition_id'=> 3,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>4,
                'name' => 'Adriana Gallegos Marina',
                'prep_party_coalition_id'=> 4,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>5,
                'name' => 'Rodulfo de la Cruz Mendez',
                'prep_party_coalition_id'=> 5,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>6,
                'name' => 'Valeria López González',
                'prep_party_coalition_id'=> 6,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>7,
                'name' => 'Gabriel Orantes Villatoro',
                'prep_party_coalition_id'=> 13,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>8,
                'name' => 'Virgilio Leon Popomeya',
                'prep_party_coalition_id'=> 14,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>9,
                'name' => 'Ediberto Gutiérrez Aguilar',
                'prep_party_coalition_id'=> 15,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>10,
                'name' => 'Gilberto Aguilar Villareal',
                'prep_party_coalition_id'=> 16,
                'photo' => 'img/candidatos/default.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>11,
                'name' => 'Candidaturas no registradas',
                'prep_party_coalition_id'=> 17,
                'photo' => null,
                'is_special'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'ordered'=>12,
                'name' => 'Votos nulos',
                'prep_party_coalition_id'=> 18,
                'photo' => null,
                'is_special'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]
        ]);
    }
}
