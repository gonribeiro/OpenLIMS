<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UserApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToListAllUsers()
    {
        User::factory()->count(10)->create();

        $response = $this->get(route('api.user.index'));

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToCreateAUser()
    {
        $user = User::factory()->make();
        $user->password = "123Qwe...";

        $response = $this->post(route('api.user.store'), $user->toArray());

        $this->assertDatabaseHas('users', Arr::except($user->toArray(), ['password', 'email_verified_at']));

        $response->assertCreated();
    }

    public function testShouldBeAbleShowAUser()
    {
        $user = User::factory()->create();

        $response = $this->get(route('api.user.show', $user));

        $response->assertJson($user->toArray());

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToUpdateAUser()
    {
        $user = User::factory()->create();

        $userUpdate = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => "123Qwe..."
        ];

        $response = $this->patch(route('api.user.update', $user), $userUpdate);

        $this->assertDatabaseHas('users', Arr::except($userUpdate, ['password']));

        $response->assertNoContent();
    }

    public function testShouldBeAbleToDestroyAUser()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('api.user.destroy', $user));

        $this->assertSoftDeleted($user);

        $response->assertNoContent();
    }

    public function testShouldBeAbleToRestoreAUserDeleted()
    {
        $user = User::factory(['deleted_at' => today()])->create();

        $response = $this->patch(route('api.user.update', $user->id), ['restore' => true]);

        $this->assertNotSoftDeleted($user);

        $response->assertNoContent();
    }
}
