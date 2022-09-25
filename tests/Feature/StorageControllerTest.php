<?php

namespace Tests\Feature;

use App\Models\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StorageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAccessTheIndexStoragePage()
    {
        $response = $this->get(route('storage.index'));

        $response->assertViewIs('storages.index');
    }

    public function testShouldBeAccessTheCreateStoragePage()
    {
        $response = $this->get(route('storage.create'));

        $response->assertViewIs('storages.form');
    }

    public function testShouldBeAbleToCreateAStorage()
    {
        $storage = Storage::factory()->make();

        $response = $this->post(route('storage.store'), $storage->toArray());

        $this->assertDatabaseHas('storages', $storage->toArray());

        $storage = Storage::get()->first();
        $response->assertRedirect(route('storage.edit', $storage));
    }

    public function testShouldBeAccessTheEditStoragePage()
    {
        $storage = Storage::factory()->create();

        $response = $this->get(route('storage.edit', $storage));

        $response->assertViewIs('storages.form');
    }

    public function testShouldBeAbleToUpdateAStorage()
    {
        $storage = Storage::factory()->create();

        $storageUpdate = Storage::factory()->make();

        $response = $this->patch(route('storage.update', $storage), $storageUpdate->toArray());

        $this->assertDatabaseHas('storages', $storageUpdate->toArray());

        $response->assertRedirect(route('storage.edit', $storage));
    }

    public function testShouldBeAbleToRestoreAStorageDeleted()
    {
        $storage = Storage::factory(['deleted_at' => today()])->create();

        $response = $this->patch(route('storage.update', $storage->id), ['restore' => true]);

        $this->assertNotSoftDeleted($storage);

        $response->assertRedirect(route('storage.edit', $storage));
    }
}
