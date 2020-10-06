<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Food;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FoodManagementTest extends TestCase
{
    use RefreshDatabase;

    public function testUnauthenticatedUserCannotCreateFood()
    {
        $food = Food::factory()->make();

        $response = $this->post($food->getRoute(), $food->toArray());

        // User is not logged in, redirected to login
        $response->assertStatus(302);
    }

    public function testUnauthenticatedUserCannotReadFood()
    {
        $food = Food::factory()->create();

        $response = $this->get($food->getRoute());

        $response->assertStatus(302);
    }

    public function testSubscriberUserCannotCreateFood()
    {
        $food = Food::factory()->make();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post($food->getBaseRoute(), $food->toArray());

        $response->assertForbidden();
    }

    public function testEditorUserCanCreateFood()
    {
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'create food']);
        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole('editor');

        $food = Food::factory()->make();

        $response = $this->actingAs($user)->post($food->getBaseRoute(), $food->toArray());

        $this->assertDatabaseHas((new Food)->getTable(), ['name' => $food->name]);

        $response->assertSee($food->name);
    }
}
