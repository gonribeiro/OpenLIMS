<?php

namespace Tests\Feature\Api\V1;

use App\Models\Custody;
use App\Models\Sample;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustodyApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToCreateACustodyAndStorageLocation()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();

        $response = $this->post(route('api.custody.store', [
            'storage_id' => 1,
            'reason' => 'Test',
            'sampleIds' => '1,2,3'
        ]));

        $this->assertDatabaseHas('custodies', ['storage_id' => 1, 'reason' => 'Test', 'sample_id' => '1']);
        $this->assertDatabaseHas('custodies', ['storage_id' => 1, 'reason' => 'Test', 'sample_id' => '2']);
        $this->assertDatabaseHas('custodies', ['storage_id' => 1, 'reason' => 'Test', 'sample_id' => '3']);

        $this->assertDatabaseCount('custodies', 3);

        $response->assertStatus(201);
    }

    public function testShouldBeAbleToShowACustodiesBySample()
    {
        $sample = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->has(Custody::factory()->forStorage())->create();

        $response = $this->get(route('api.custody.findBySampleId', [
            'sample_type' => 'Sample',
            'sample_id' => 1
        ]));

        $response->assertJsonFragment($sample->lastCustody->toArray());

        $response->assertStatus(200);
    }
}
