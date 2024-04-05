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
        
        /*$user= \App\Models\User::factory()->create([
            'name' => 'Administrador Prep',
            'email' => 'adminprep@gmail.com',
            'celular' => '9611234567',
            'password' => Hash::make('adminprep2024'),
        ]);         
        $user->assignRole('prep');*/


        /*$this->call(PrepElectionTypeSeeder::class);
        $this->call(PrepElectionSeeder::class);
        $this->call(PrepPartyCoalitionSeeder::class);
        $this->call(PrepCandidateSeeder::class);  */      
        //$this->call(PrepCandidatePartyCoalitionSeeder::class);

        $this->call(PrepPollingPlaceVoteSeeder::class);
    }
}
