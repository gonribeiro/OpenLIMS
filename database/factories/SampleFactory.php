<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Enums\UnitMeasurement;
use App\Models\SampleType;
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
            'internal_id' => fake()->numerify('##-####'),
            'external_id' => fake()->numerify('##-####'),
            'customer_id' => User::find(rand(1, count(User::all()))),
            'value_unit' => rand(1, 10),
            'sample_type_id' => SampleType::find(rand(1, count(SampleType::all()))),
            'unit' => UnitMeasurement::getRandomValue(),
            'status' => Status::getRandomValue(),
            'collected_date' => fake()->dateTime(),
            'collected_by_id' => User::find(rand(1, count(User::all()))),
            'received_date' => fake()->dateTime(),
            'received_by_id' => User::find(rand(1, count(User::all()))),
        ];
    }
}
