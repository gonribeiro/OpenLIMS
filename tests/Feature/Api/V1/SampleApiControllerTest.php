<?php

namespace Tests\Feature\Api\V1;

use App\Models\Sample;
use App\Models\Storage;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SampleApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToListAllSamples()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(10)->create();

        $response = $this->get(route('api.sample.index'));

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToCreateASamples()
    {
        $samples['samples'] = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(2)->make()->toArray();

        $response = $this->post(route('api.sample.store'), $samples);

        $this->assertDatabaseHas('samples', Arr::except($samples['samples'][0], ['collected_date', 'received_date']));
        $this->assertDatabaseHas('samples', Arr::except($samples['samples'][1], ['collected_date', 'received_date']));

        $response->assertCreated();
    }

    public function testShouldBeAbleToCreateASamplesWithTests()
    {
        $samples['samples'] = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(2)->make()->toArray();

        $samples['samples'][0]['tests'] = Test::factory(['sample_id' => 1])
            ->count(2)
            ->state(new Sequence(
                ['analysis_id' => '1'],
                ['analysis_id' => '20'],
            ))
            ->make()
            ->toArray();

        $response = $this->post(route('api.sample.store'), $samples);

        $this->assertDatabaseHas('tests', Arr::except($samples['samples'][0]['tests'][0], ['created_at', 'updated_at']));
        $this->assertDatabaseHas('tests', Arr::except($samples['samples'][0]['tests'][1], ['created_at', 'updated_at']));

        $response->assertCreated();
    }

    public function testShouldBeAbleToCreateASamplesWithStorageLocation()
    {
        $storage = Storage::factory()->create();

        $samples['samples'][0] = Sample::factory(['storage_id' => $storage->id])
            ->forCustomer()
            ->forCollectedBy()
            ->forReceivedBy()
            ->make()
            ->toArray();

        $response = $this->post(route('api.sample.store'), $samples);

        $this->assertDatabaseHas('custodies', [
            'storage_id' => $storage->id,
            'sample_type' => 'Sample',
            'sample_id' => 1
        ]);

        $response->assertCreated();
    }

    public function testShouldBeAbleToShowASamples()
    {
        $samples = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();

        $response = $this->get(route('api.sample.findByIds', $samples->implode('id', ',')));

        $response->assertJson($samples->toArray());

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToUpdateASamples()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();

        $samplesUpdate['samples'] = Sample::factory()
            ->count(2)
            ->state(new Sequence(
                ['id' => '1'],
                ['id' => '3'],
            ))->make()
            ->toArray();

        $response = $this->patch(route('api.sample.updateByIds', $samplesUpdate));

        $this->assertDatabaseHas('samples', Arr::except($samplesUpdate['samples'][0], ['collected_date', 'received_date']));
        $this->assertDatabaseHas('samples', Arr::except($samplesUpdate['samples'][1], ['collected_date', 'received_date']));

        $response->assertNoContent();
    }

    public function testShouldBeAbleToDestroyASample()
    {
        $sample = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->create();

        $response = $this->delete(route('api.sample.destroy', $sample));

        $this->assertSoftDeleted($sample);

        $response->assertNoContent();
    }

    public function testShouldBeAbleToRestoreASampleDeleted()
    {
        $samplesUpdate = Sample::factory(['deleted_at' => today()])
            ->forCustomer()
            ->forCollectedBy()
            ->forReceivedBy()
            ->count(2)
            ->create();

        $request = [
            'samples' => [
                0 => [
                    'id' => 1,
                    'restore' => true
                ],
                1 => [
                    'id' => 2,
                    'restore' => true
                ],
            ]
        ];

        $response = $this->patch(route('api.sample.updateByIds', $request));

        $this->assertNotSoftDeleted($samplesUpdate[0]);
        $this->assertNotSoftDeleted($samplesUpdate[1]);

        $response->assertNoContent();
    }
}
