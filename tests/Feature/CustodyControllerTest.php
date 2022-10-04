<?php

namespace Tests\Feature;

use App\Models\Sample;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustodyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToCreateACustodyAndStorageLocationForManySamples()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();

        $response = $this->post(route('custody.store', [
            'storage_id' => 1,
            'reason' => 'Test',
            'sampleIds' => '1,2,3'
        ]));

        $this->assertDatabaseHas('custodies', ['storage_id' => 1, 'reason' => 'Test', 'sample_id' => '1']);
        $this->assertDatabaseHas('custodies', ['storage_id' => 1, 'reason' => 'Test', 'sample_id' => '2']);
        $this->assertDatabaseHas('custodies', ['storage_id' => 1, 'reason' => 'Test', 'sample_id' => '3']);

        $this->assertDatabaseCount('custodies', 3);

        $response->assertRedirect(route('sample.index'));
    }

    public function testShouldBeAbleToCreateACustodyAndStorageLocationForOneSample()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();

        $response = $this->post(route('custody.store', [
            'storage_id' => 1,
            'reason' => 'Test',
            'sampleIds' => '2'
        ]));

        $this->assertDatabaseHas('custodies', ['storage_id' => 1, 'reason' => 'Test', 'sample_id' => '2']);

        $this->assertDatabaseCount('custodies', 1);

        $response->assertRedirect(route('custody.edit', ['sample' => 2]));
    }

    public function testShouldBeAccessTheCreateCustodyPage()
    {
        $response = $this->get(route('custody.create', ['sampleIds' => '1,2,3']));

        $response->assertViewIs('custody.create');
    }

    public function testShouldBeAccessTheEditCustodyPage()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();

        $response = $this->get(route('custody.edit', ['sample' => 1]));

        $response->assertViewIs('custody.edit');
    }
}
