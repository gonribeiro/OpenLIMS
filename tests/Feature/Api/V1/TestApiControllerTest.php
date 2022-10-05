<?php

namespace Tests\Feature\Api\V1;

use App\Models\Analysis;
use App\Models\Sample;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToCreateATestsForManySamples()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();
        Analysis::factory()->count(2)->create();
        $tests = Test::factory()->count(2)->state(new Sequence(
            ['analysis_id' => '1'],
            ['analysis_id' => '20'],
        ))->make()->toArray();

        $response = $this->post(route('api.test.store', [
            'tests' => $tests,
            'sampleIds' => '1,2,3'
        ]));

        $this->assertDatabaseHas('tests', ['analysis_id' => 1, 'sample_type' => 'Sample', 'sample_id' => '1']);
        $this->assertDatabaseHas('tests', ['analysis_id' => 20, 'sample_type' => 'Sample', 'sample_id' => '2']);
        $this->assertDatabaseHas('tests', ['analysis_id' => 1, 'sample_type' => 'Sample', 'sample_id' => '3']);

        $this->assertDatabaseCount('tests', 6);

        $response->assertStatus(201);
    }

    public function testShouldBeAbleToShowATestsBySample()
    {
        $sample = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->has(Test::factory()->forAnalysis())->create();

        $response = $this->get(route('api.test.findBySampleId', [
            'sample_type' => 'Sample',
            'sample_id' => 1
        ]));

        $response->assertJsonFragment($sample->tests->toArray());

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToDestroyATest()
    {
        $sample = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->has(Test::factory()->forAnalysis())->create();

        $response = $this->delete(route('api.test.destroy', $sample->tests[0]));

        $this->assertSoftDeleted($sample->tests[0]);

        $response->assertNoContent();
    }
}
