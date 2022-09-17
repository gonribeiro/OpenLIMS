<?php

namespace Database\Factories;

use App\Models\SampleType;
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
            'sample_type_id' => SampleType::find(rand(1, count(SampleType::all()))),
            'result_attributes' => '{}',
            'created_by_id' => User::find(rand(1, count(User::all()))),
        ];
    }
}
