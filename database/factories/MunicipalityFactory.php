<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Municipality;
use App\Models\State;

class MunicipalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Municipality::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'state_id' => State::factory(),
            'key' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'name' => $this->faker->name,
            'is_active' => $this->faker->boolean,
        ];
    }
}
