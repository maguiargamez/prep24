<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Election;
use App\Models\Municipality;
use App\Models\PollingPlace;

class PollingPlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PollingPlace::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'election_id' => Election::factory(),
            'municipality_id' => Municipality::factory(),
            'local_district' => $this->faker->numberBetween(-1000, 1000),
            'federal_district' => $this->faker->numberBetween(-1000, 1000),
            'section' => $this->faker->numberBetween(-1000, 1000),
            'section_type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'type_key' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'electoral_register' => $this->faker->numberBetween(-1000, 1000),
            'nominal_electoral_register' => $this->faker->numberBetween(-1000, 1000),
            'installation_address' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'leftover_ballots' => $this->faker->numberBetween(-1000, 1000),
            'received_ballots' => $this->faker->numberBetween(-1000, 1000),
            'special_ballots' => $this->faker->numberBetween(-1000, 1000),
            'special_received_ballots' => $this->faker->numberBetween(-1000, 1000),
            'taken_ballots' => $this->faker->numberBetween(-1000, 1000),
            'observations' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'digitized_record' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'is_active' => $this->faker->boolean,
        ];
    }
}
