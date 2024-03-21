<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        Candidate::insert([
            [
                'election_id'=> 1,
                'party_coalition_id'=> 12,
                'name' => 'José Antonio Aguilar Bodegas',
                'photo' => 'img/candidatos/jose_aguilar.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'name' => 'Roberto Albores Gleason',
                'party_coalition_id'=> 20,
                'photo' => 'img/candidatos/roberto_albores.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'name' => 'Rutilio Escandón Cadenas',
                'party_coalition_id'=> 16,
                'photo' => 'img/candidatos/rutilio_escandon.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'party_coalition_id'=> 21,
                'name' => 'Fernando Castellanos Cal y Mayor',
                'photo' => 'img/candidatos/fernando_castellanos.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'name' => 'Jesús Alejo Orantes Ruíz',
                'party_coalition_id'=> 25,
                'photo' => 'img/candidatos/jesus_orantes.jpg',
                'is_special'=> false,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'name' => 'Candidaturas no registradas',
                'party_coalition_id'=> 26,
                'photo' => null,
                'is_special'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'name' => 'Votos nulos',
                'party_coalition_id'=> 27,
                'photo' => null,
                'is_special'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
