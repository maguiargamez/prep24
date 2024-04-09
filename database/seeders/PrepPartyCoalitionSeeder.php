<?php

namespace Database\Seeders;

use App\Models\PrepPartyCoalition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrepPartyCoalitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        PrepPartyCoalition::insert([
            [
                'prep_election_id'=> 1,
                'short' => 'FYC',
                'name' => 'FYC',
                'logo' => 'img/logos/fyc.jpg',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'MC',
                'name' => 'MC',
                'logo' => 'img/logos/mc.jpg',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'PAN',
                'name' => 'PAN',
                'logo' => 'img/logos/pan.jpg',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'PRI',
                'name' => 'PRI',
                'logo' => 'img/logos/pri.jpg',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'PRD',
                'name' => 'PRD',
                'logo' => 'img/logos/prd.jpg',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'PAN-PRI-PRD',
                'name' => 'PAN-PRI-PRD',
                'logo' => 'img/logos/pan-pri-prd.jpg',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'PAN-PRI',
                'name' => 'PAN-PRI',
                'logo' => 'img/logos/pan-pri.jpg',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'PAN-PRD',
                'name' => 'PAN-PRD',
                'logo' => 'img/logos/pan-prd.jpg',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'PRI-PRD',
                'name' => 'PRI-PRD',
                'logo' => 'img/logos/pri-prd.jpg',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'Candidatura no registrada',
                'name' => 'Candidatura no registrada',
                'logo' => null,
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_election_id'=> 1,
                'short' => 'Votos nulos',
                'name' => 'Votos nulos',
                'logo' => null,
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
