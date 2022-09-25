<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAccessTheIndexUserPage()
    {
        $response = $this->get(route('user.index'));

        $response->assertViewIs('users.index');
    }

    public function testShouldBeAccessTheCreateUserPage()
    {
        $response = $this->get(route('user.create'));

        $response->assertViewIs('users.form');
    }

    public function testShouldBeAbleToCreateAUser()
    {
        $user = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => "123Qwe..."
        ];

        $response = $this->post(route('user.store'), $user);

        $this->assertDatabaseHas('users', Arr::except($user, ['password']));

        $user = User::get()->first();
        $response->assertRedirect(route('user.edit', $user));
    }

    public function testShouldBeAccessTheEditUserPage()
    {
        $user = User::factory()->create();

        $response = $this->get(route('user.edit', $user));

        $response->assertViewIs('users.form');
    }

    public function testShouldBeAbleToUpdateAUser()
    {
        $user = User::factory()->create();

        $userUpdate = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => "123Qwe..."
        ];

        $response = $this->patch(route('user.update', $user), $userUpdate);

        $this->assertDatabaseHas('users', Arr::except($userUpdate, ['password']));

        $response->assertRedirect(route('user.edit', $user));
    }

    public function testShouldBeAbleToRestoreAUserDeleted()
    {
        $user = User::factory(['deleted_at' => today()])->create();

        $response = $this->patch(route('user.update', $user->id), ['restore' => true]);

        $this->assertNotSoftDeleted($user);

        $response->assertRedirect(route('user.edit', $user));
    }
}
