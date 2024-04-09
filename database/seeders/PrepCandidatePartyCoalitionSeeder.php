<?php

namespace Database\Seeders;

use App\Models\PrepCandidatePartyCoalition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrepCandidatePartyCoalitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        PrepCandidatePartyCoalition::insert([
            [
                'prep_candidate_id'=> 1,
                'prep_party_coalition_id'=> 1,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 2,
                'prep_party_coalition_id'=> 2,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 3,
                'prep_party_coalition_id'=> 3,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 3,
                'prep_party_coalition_id'=> 4,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 3,
                'prep_party_coalition_id'=> 5,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 3,
                'prep_party_coalition_id'=> 6,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 3,
                'prep_party_coalition_id'=> 7,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 3,
                'prep_party_coalition_id'=> 8,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 3,
                'prep_party_coalition_id'=> 9,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 4,
                'prep_party_coalition_id'=> 10,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'prep_candidate_id'=> 5,
                'prep_party_coalition_id'=> 11,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]

        ]);
    }
}
