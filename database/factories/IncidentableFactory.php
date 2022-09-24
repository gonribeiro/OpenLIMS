<?php

namespace Database\Factories;

use App\Models\Incident;
use App\Models\Sample;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SampleIncident>
 */
class IncidentableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'incident_id' => Incident::find(rand(1, count(Incident::all()))),
            'incidentable_id' => Sample::find(rand(1, count(Sample::all()))),
            'incidentable_type' => fake()->randomElement(['Sample', 'Subsample']),
        ];
    }
}
