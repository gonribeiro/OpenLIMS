<?php

namespace Database\Factories;

use App\Enums\SampleType;
use App\Enums\Status;
use App\Enums\UnitMeasurement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sample>
 */
class SampleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'internalId' => fake()->numerify('##-####'),
            'externalId' => fake()->numerify('##-####'),
            'customer_id' => User::find(rand(1, count(User::all()))),
            'value_unit' => rand(1, 10),
            'sample_type' => SampleType::getRandomValue(),
            'unit' => UnitMeasurement::getRandomValue(),
            'collected_date' => fake()->dateTime(),
            'collected_by_id' => User::find(rand(1, count(User::all()))),
            'received_date' => fake()->dateTime(),
            'received_by_id' => User::find(rand(1, count(User::all()))),
        ];
    }
}
