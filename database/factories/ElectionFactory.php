<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Election;
use App\Models\ElectionType;
use App\Models\Municipality;
use App\Models\State;

class ElectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Election::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'election_type_id' => ElectionType::factory(),
            'state_id' => State::factory(),
            'municipality_id' => Municipality::factory(),
            'description' => $this->faker->text,
        ];
    }
}
