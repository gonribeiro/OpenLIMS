<?php

namespace Database\Factories;

use App\Enums\CustodyType;
use App\Models\Sample;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Custody>
 */
class CustodyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'storage_id' => Storage::find(rand(1, count(Storage::all()))),
            'sample_id' => Sample::find(rand(1, count(Sample::all()))),
            'sample_type' => fake()->randomElement(['Sample', 'Subsample']),
            'custody_type' => CustodyType::getRandomValue(),
            'reason' => fake()->text(),
        ];
    }
}
