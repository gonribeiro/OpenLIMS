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

        $response->assertViewIs('user.index');
    }

    public function testShouldBeAccessTheCreateUserPage()
    {
        $response = $this->get(route('user.create'));

        $response->assertViewIs('user.form');
    }

    public function testShouldBeAbleToCreateAUser()
    {
        $user = User::factory()->make();
        $user->password = "123Qwe...";

        $response = $this->post(route('user.store'), $user->toArray());

        $this->assertDatabaseHas('users', Arr::except($user->toArray(), ['password', 'email_verified_at']));

        $user = User::get()->first();
        $response->assertRedirect(route('user.edit', $user));
    }

    public function testShouldBeAccessTheEditUserPage()
    {
        $user = User::factory()->create();

        $response = $this->get(route('user.edit', $user));

        $response->assertViewIs('user.form');
    }

    public function testShouldBeAbleToUpdateAUser()
    {
        $user = User::factory()->create();

        $userUpdate = User::factory(['password' => '123Qwe...'])->make()->toArray();

        $response = $this->patch(route('user.update', $user), $userUpdate);

        $this->assertDatabaseHas('users', Arr::except($userUpdate, ['password', 'email_verified_at']));

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
