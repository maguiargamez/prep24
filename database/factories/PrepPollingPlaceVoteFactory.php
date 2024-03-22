<?php

namespace Database\Factories;

use App\Models\PrepPartyCoalition;
use App\Models\PrepPollingPlaceRecord;
use App\Models\PrepPollingPlaceVote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrepPollingPlaceVote>
 */
class PrepPollingPlaceVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prep_election_id' => 1,
            'prep_polling_place_record_id' => PrepPollingPlaceRecord::factory(),
            'prep_party_coalition_id' => PrepPartyCoalition::factory(),
            'votes' => $this->faker->numberBetween(-1000, 1000),
        ];
    }
}
