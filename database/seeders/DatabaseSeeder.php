<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sample;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        \App\Models\Subsample::factory(400)->create();
        \App\Models\Analysis::factory(20)->create();
        \App\Models\Test::factory(400)->create();
        \App\Models\Incident::factory(50)->create();
        \App\Models\Incidentable::factory(50)->create();
        \App\Models\Storage::factory(100)->create();
        \App\Models\Custody::factory(300)->create();
        \App\Models\Result::factory(200)->create();

        \App\Models\Analysis::factory()->create(['name' => 'Test', 'attributes' => '
            {
                "0": {
                    "name": "Text Example",
                    "config": {
                        "type": "text",
                        "required": "true",
                        "minlength": 1,
                        "maxlength": 255
                    }
                },
                "1": {
                    "name": "Number Example",
                    "config": {
                        "type": "number",
                        "required": "true",
                        "min": 0.1,
                        "max": 255
                    }
                },
                "2":{
                    "name": "Data Example",
                    "config": {
                        "type": "date",
                        "required": "true",
                        "min": "01-01-1900",
                        "max": "today()"
                    }
                }
            }
        ']);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
