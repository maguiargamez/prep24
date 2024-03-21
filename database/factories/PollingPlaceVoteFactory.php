<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PartyCoalition;
use App\Models\PollingPlace;
use App\Models\PollingPlaceVote;

class PollingPlaceVoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PollingPlaceVote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'polling_place_id' => PollingPlace::factory(),
            'party_coalition_id' => PartyCoalition::factory(),
            'votes' => $this->faker->numberBetween(-1000, 1000),
        ];
    }
}
