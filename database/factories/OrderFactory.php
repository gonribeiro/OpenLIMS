<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Analysis;
use App\Models\OrderType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_type_id' => OrderType::find(rand(1, count(OrderType::all()))),
            'analysis_id' => Analysis::find(rand(1, count(Analysis::all()))),
            'status' => Status::getRandomValue(),
        ];
    }
}
