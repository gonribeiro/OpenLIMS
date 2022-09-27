<?php

namespace Database\Factories;

use App\Enums\SampleType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Analysis>
 */
class AnalysisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'sample_type' => SampleType::getRandomValue(),
            'attributes' => '{}',
            // 'created_by_id' => User::find(rand(1, count(User::all()))),
            'sample_type' => SampleType::getRandomValue(),
        ];
    }
}
