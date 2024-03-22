<?php

namespace Database\Factories;

use App\Models\PrepElectionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrepElection>
 */
class PrepElectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prep_election_type_id' => PrepElectionType::factory(),
            'state_id' => 1,
            'municipality_id' => null,
            'description' => $this->faker->text,
        ];
    }
}
