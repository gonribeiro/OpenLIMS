<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'test_id' => Test::find(rand(1, count(Test::all()))),
            'status' => Status::getRandomValue(),
            'attributes' => '{}',
        ];
    }
}
