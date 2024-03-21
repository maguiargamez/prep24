<?php

namespace Database\Seeders;

use App\Models\PartyCoalition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartyCoalitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        PartyCoalition::insert([
            [
                'election_id'=> 1,
                'short' => 'PAN',
                'name' => 'PAN',
                'logo' => 'img/logos/pan.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PRI',
                'name' => 'PRI',
                'logo' => 'img/logos/pri.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PRD',
                'name' => 'PRD',
                'logo' => 'img/logos/prd.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PT',
                'name' => 'PT',
                'logo' => 'img/logos/pt.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PV',
                'name' => 'PV',
                'logo' => 'img/logos/pv.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'MC',
                'name' => 'MC',
                'logo' => 'img/logos/mc.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'NA',
                'name' => 'NA',
                'logo' => 'img/logos/na.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'CSU',
                'name' => 'CSU',
                'logo' => 'img/logos/csu.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'MOR',
                'name' => 'Morena',
                'logo' => 'img/logos/mor.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PES',
                'name' => 'PES',
                'logo' => 'img/logos/pes.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'MCS',
                'name' => 'MCS',
                'logo' => 'img/logos/mcs.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PAN-PRD-MC',
                'name' => 'PAN-PRD-MC',
                'logo' => 'img/logos/PAN-PRD-MC.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PAN-PRD',
                'name' => 'PAN-PRD',
                'logo' => 'img/logos/PAN-PRD.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PAN-MC',
                'name' => 'PAN-MC',
                'logo' => 'img/logos/PAN-MC.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PRD-MC',
                'name' => 'PRD-MC',
                'logo' => 'img/logos/PRD-MC.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PT-MOR-PES',
                'name' => 'PT-MOR-PES',
                'logo' => 'img/logos/PT-MOR-PES.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PT-MOR',
                'name' => 'PT-MOR',
                'logo' => 'img/logos/PT-MOR.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PT-PES',
                'name' => 'PT-PES',
                'logo' => 'img/logos/PT-PES.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'MOR-PES',
                'name' => 'MOR-PES',
                'logo' => 'img/logos/MOR-PES.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PRI-NA',
                'name' => 'PRI-NA',
                'logo' => 'img/logos/PRI-NA.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PV-CSU-MCS',
                'name' => 'PV-CSU-MCS',
                'logo' => 'img/logos/PV-CSU-MCS.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PV-CSU',
                'name' => 'PV-CSU',
                'logo' => 'img/logos/PV-CSU.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'PV-MCS',
                'name' => 'PV-MCS',
                'logo' => 'img/logos/PV-MCS.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'CSU-MCS',
                'name' => 'CSU-MCS',
                'logo' => 'img/logos/CSU-MCS.png',
                'parties' => null,
                'is_coalition' => true,
                'is_independent' => false,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
                'short' => 'indep_1',
                'name' => 'indep_1',
                'logo' => 'img/logos/indep_1.png',
                'parties' => null,
                'is_coalition' => false,
                'is_independent' => true,
                'is_active'=> true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_id'=> 1,
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
                'election_id'=> 1,
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