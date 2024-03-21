<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\State;

class StateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'country_id' => Country::factory(),
            'key' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'name' => $this->faker->name,
            'short' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'is_active' => $this->faker->boolean,
        ];
    }
}
