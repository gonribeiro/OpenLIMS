<?php

namespace Tests\Feature\Api\V1;

use App\Models\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StorageApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToListAllStorages()
    {
        Storage::factory()->count(10)->create();

        $response = $this->get(route('api.storage.index'));

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToCreateAStorages()
    {
        $storage = Storage::factory()->make();

        $response = $this->post(route('api.storage.store'), $storage->toArray());

        $this->assertDatabaseHas('storages', $storage->toArray());

        $response->assertCreated();
    }

    public function testShouldBeAbleToShowAStorage()
    {
        $storage = Storage::factory()->create();

        $response = $this->get(route('api.storage.show', $storage));

        $response->assertJson($storage->toArray());

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToUpdateAStorage()
    {
        $storage = Storage::factory()->create();

        $storageUpdate = Storage::factory()->make();

        $response = $this->patch(route('api.storage.update', $storage), $storageUpdate->toArray());

        $this->assertDatabaseHas('storages', $storageUpdate->toArray());

        $response->assertNoContent();
    }

    public function testShouldBeAbleToDestroyAStorage()
    {
        $storage = Storage::factory()->create();

        $response = $this->delete(route('api.storage.destroy', $storage));

        $this->assertSoftDeleted($storage);

        $response->assertNoContent();
    }

    public function testShouldBeAbleToRestoreAStorageDeleted()
    {
        $storage = Storage::factory(['deleted_at' => today()])->create();

        $response = $this->patch(route('api.storage.update', $storage->id), ['restore' => true]);

        $this->assertNotSoftDeleted($storage);

        $response->assertNoContent();
    }
}
