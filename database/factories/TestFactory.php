<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Analysis;
use App\Models\Sample;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
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
            'sample_type' => 'Sample',
            'analysis_id' => Analysis::find(rand(1, count(Analysis::all()))),
            'status' => Status::getRandomValue(),
            'created_by_id' => User::find(rand(1, count(User::all()))),
        ];
    }
}
