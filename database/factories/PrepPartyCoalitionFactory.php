<?php

namespace Database\Factories;

use App\Models\PrepElection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrepPartyCoalition>
 */
class PrepPartyCoalitionFactory extends Factory
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
            'short' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'name' => $this->faker->name,
            'logo' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'parties' => '{}',
            'is_coalition' => $this->faker->boolean,
            'is_independent' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
        ];
    }
}
