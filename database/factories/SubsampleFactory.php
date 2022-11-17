<?php

namespace Database\Factories;

use App\Enums\UnitMeasurement;
use App\Models\Sample;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subsample>
 */
class SubsampleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sample_id' => Sample::find(rand(1, count(Sample::all()))),
            'internalId' => fake()->numerify('##-####'),
            'value_unit' => rand(1, 10),
            'unit' => UnitMeasurement::getRandomValue(),
        ];
    }
}
