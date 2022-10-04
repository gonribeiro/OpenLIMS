<?php

namespace Tests\Feature;

use App\Models\Sample;
use App\Models\Storage;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SampleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAccessTheIndexSamplePage()
    {
        $response = $this->get(route('sample.index'));

        $response->assertViewIs('sample.index');
    }

    public function testShouldBeAccessTheSampleQuantityCreateDialogPage()
    {
        $response = $this->get(route('sample.quantityCreateDialog'));

        $response->assertViewIs('sample.quantityCreateDialog');
    }

    public function testShouldBeAccessTheCreateSamplePage()
    {
        $response = $this->get(route('sample.create', ['quantity' => 5]));

        $response->assertViewIs('sample.form');
    }

    public function testShouldBeAbleToCreateASamplesWithTestsAndStorageLocation()
    {
        $storage = Storage::factory()->create();

        $samples['samples'] = Sample::factory(['storage_id' => $storage->id])
            ->forCustomer()
            ->forCollectedBy()
            ->forReceivedBy()
            ->count(2)
            ->make()
            ->toArray();

        $samples['samples'][0]['tests'] = Test::factory(['sample_id' => 1])
            ->count(2)
            ->state(new Sequence(
                ['analysis_id' => '1'],
                ['analysis_id' => '20'],
            ))
            ->make()
            ->toArray();

        $response = $this->post(route('sample.store'), $samples);

        $this->assertDatabaseHas('samples', Arr::except($samples['samples'][0], ['collected_date', 'received_date', 'storage_id', 'tests']));
        $this->assertDatabaseHas('samples', Arr::except($samples['samples'][1], ['collected_date', 'received_date', 'storage_id']));
        $this->assertDatabaseHas('custodies', ['storage_id' => $storage->id, 'sample_type' => 'Sample', 'sample_id' => 1]);
        $this->assertDatabaseHas('custodies', ['storage_id' => $storage->id, 'sample_type' => 'Sample', 'sample_id' => 2]);
        $this->assertDatabaseHas('tests', Arr::except($samples['samples'][0]['tests'][0], ['created_at', 'updated_at']));
        $this->assertDatabaseHas('tests', Arr::except($samples['samples'][0]['tests'][1], ['created_at', 'updated_at']));

        $this->assertDatabaseCount('samples', 2);
        $this->assertDatabaseCount('custodies', 2);
        $this->assertDatabaseCount('tests', 2);

        $response->assertRedirect(route('sample.index'));
    }

    public function testShouldBeAccessTheEditSamplesPage()
    {
        $samples = Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(5)->make();

        $response = $this->get(route('sample.edit', $samples->implode('id', ',')));

        $response->assertViewIs('sample.form');
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

        $response = $this->patch(route('sample.updateByIds', $request));

        $this->assertNotSoftDeleted($samplesUpdate[0]);
        $this->assertNotSoftDeleted($samplesUpdate[1]);

        $response->assertRedirect(route('sample.edit', ['ids' => '1,2']));
    }
}
