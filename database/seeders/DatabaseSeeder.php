<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminprep2024'),
        ]);       

        //$this->call(StateSeeder::class);
        //$this->call(MunicipalitySeeder::class);
        $this->call(ElectionTypeSeeder::class);
        $this->call(ElectionSeeder::class);
        

        $this->call(PartyCoalitionSeeder::class);
        $this->call(CandidateSeeder::class);
        //$this->call(PollingPlaceVoteSeeder::class);
        //$this->call(CandidatePartyCoalitionSeeder::class);
    }
}
