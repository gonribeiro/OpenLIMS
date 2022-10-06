<?php

namespace Tests\Feature;

use App\Models\Analysis;
use App\Models\Sample;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToCreateATestsForManySamples()
    {
        $sample = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();
        Analysis::factory()->count(2)->create();
        $tests = Test::factory()->count(2)->state(new Sequence(
            ['analysis_id' => '1'],
            ['analysis_id' => '20'],
        ))->make()->toArray();

        $response = $this->post(route('test.store', [
            'tests' => $tests,
            'sampleIds' => $sample->id
        ]));

        $this->assertDatabaseHas('tests', ['analysis_id' => 1, 'sample_type' => 'Sample', 'sample_id' => '1']);
        $this->assertDatabaseHas('tests', ['analysis_id' => 20, 'sample_type' => 'Sample', 'sample_id' => '1']);

        $this->assertDatabaseCount('tests', 2);

        $response->assertRedirect(route('test.edit', ['sample' => $sample->id]));
    }

    public function testShouldBeAccessTheEditTestPage()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();

        $response = $this->get(route('test.edit', ['sample' => 1]));

        $response->assertViewIs('test.form');
    }
}
