<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Election;
use App\Models\PartyCoalition;

class PartyCoalitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartyCoalition::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'election_id' => Election::factory(),
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
