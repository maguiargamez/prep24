<?php

namespace Database\Seeders;

use App\Models\PrepElection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrepElectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        PrepElection::insert([
            [
                'prep_election_type_id'=> 1,
                'state_id' => 1,
                'description' => 'Elecciones Estatales de Chiapas 2018',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]
        ]);
    }
}
