<?php

namespace Database\Factories;

use App\Models\PrepElection;
use App\Models\PrepPartyCoalition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrepCandidate>
 */
class PrepCandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prep_election_id' => PrepElection::factory(),
            'prep_party_coalition_id' => PrepPartyCoalition::factory(),
            'key' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'name' => $this->faker->name,
            'logo' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'is_active' => $this->faker->boolean,
        ];
    }
}
