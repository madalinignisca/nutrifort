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

    protected function setUp(): void
    {
        parent::setUp();

        $this->tableName = (new Food)->getTable();
    }

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

        $this->assertDatabaseHas($this->tableName, ['name' => $food->name]);

        $response->assertSee($food->name);
    }



    public function testEditorUserCanUpdateFood()
    {
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'update food']);
        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole('editor');

        $food = Food::factory()->create();
        do {
            $newFood = Food::factory()->make();
        } while ($food->name == $newFood->name); // make sure faker is not giving identical value

        $response = $this->actingAs($user)->put($food->getRoute(), $newFood->toArray());

        $this->assertDatabaseMissing($this->tableName, ['name' => $food->name]);
        $this->assertDatabaseHas($this->tableName, ['name' => $newFood->name]);

        $response->assertSee($newFood->name);
    }
}
