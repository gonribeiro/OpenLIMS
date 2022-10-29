<?php

namespace Tests\Feature\Api\V1;

use App\Models\Sample;
use App\Models\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResultApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToListResultsFindByTestIds() // testShouldBeAbleToListAllIncidents
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();

        $tests = Test::factory(['sample_id' => 1, 'sample_type' => 'Sample'])->forAnalysis()->count(5)->create();

        $response = $this->get(route('api.result.findResultsByTestIds', $tests->implode('id', ',')));

        $response->assertJson($tests->toArray());

        $response->assertStatus(200);
    }

    public function testShouldBeCreateResults()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();

        Test::factory(['sample_id' => 1, 'sample_type' => 'Sample'])->forAnalysis(([
            'attributes' => '
                {
                    "0": {
                        "name": "Test 1",
                        "config": {
                            "type": "text",
                            "required": "true",
                            "minlength": 1,
                            "maxlength": 255
                        }
                    },
                    "1": {
                        "name": "Test 2",
                        "config": {
                            "type": "text",
                            "required": "true",
                            "min": 0.1,
                            "max": 255
                        }
                    }
                }
            ']))->create();

        $response = $this->post(route('api.result.storeOrUpdate', [
            'results' => [
                ['test_id' => '1', 'Test 1' => 'Update 1', 'Test 2' => 'Update 2']
            ]
        ]));

        $this->assertDatabaseHas('results', [
            'value' => 'Update 1',
            'name' => 'Test 1',
            'config' => '{"type":"text","required":"true","minlength":1,"maxlength":255}'
        ]);
        $this->assertDatabaseHas('results', [
            'value' => 'Update 2',
            'name' => 'Test 2',
            'config' => '{"type":"text","required":"true","min":0.1,"max":255}'
        ]);

        $this->assertDatabaseCount('results', 2);

        $response->assertStatus(204);
    }

    public function testShouldntBeAbleToCreateResultsWhenAttributeNameRequestAndAttributeNameInAnalysisDoesntMatch()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();

        Test::factory(['sample_id' => 1, 'sample_type' => 'Sample'])->forAnalysis(([
            'attributes' => '
                {
                    "0": {
                        "name": "Test 1",
                        "config": {
                            "type": "text",
                            "required": "true",
                            "minlength": 1,
                            "maxlength": 255
                        }
                    },
                    "1": {
                        "name": "Test 2",
                        "config": {
                            "type": "text",
                            "required": "true",
                            "min": 0.1,
                            "max": 255
                        }
                    }
                }
            ']))->create();

        $response = $this->post(route('api.result.storeOrUpdate', [
            'results' => [
                [
                    'test_id' => '1',
                    'OtherName 1' => 'Update 1', // Name is different
                    'Test 2' => 'Update 2'
                ]
            ]
        ]));

        $this->assertDatabaseCount('results', 0);

        $response->assertStatus(409);
    }

    public function testShouldBeUpdateResults()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();

        Test::factory(['sample_id' => 1, 'sample_type' => 'Sample'])->forAnalysis()->hasResults(2)->create();

        $response = $this->post(route('api.result.storeOrUpdate', [
            'results' => [
                ['result_id' => '1', 'Test 1' => 'Update One'],
                ['result_id' => '2', 'Test 2' => 'Update Two']
            ]
        ]));

        $this->assertDatabaseHas('results', ['value' => 'Update One']);
        $this->assertDatabaseHas('results', ['value' => 'Update Two']);

        $this->assertDatabaseCount('results', 2);

        $response->assertStatus(204);
    }
}
