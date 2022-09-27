<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Sample::factory(200)->create();
        \App\Models\Analysis::factory(20)->create();
        \App\Models\OrderType::factory(30)->create();
        \App\Models\Order::factory(100)->create();
        \App\Models\Subsample::factory(400)->create();
        \App\Models\Test::factory(400)->create();
        \App\Models\Incident::factory(50)->create();
        \App\Models\Incidentable::factory(50)->create();
        \App\Models\Storage::factory(100)->create();
        \App\Models\Custody::factory(300)->create();
        \App\Models\Result::factory(200)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
