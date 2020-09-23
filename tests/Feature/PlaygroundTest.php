<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Food;

class PlaygroundTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $food = Food::factory()->create();
        $this->assertDatabaseHas('food', [
            'name' => $food->name,
        ]);

        $response = $this->get('/food');

        $response->assertStatus(200)
            ->assertSeeText($food->name)
            ->assertSeeText($food->fat)
            ->assertSeeText($food->saturated_fat)
            ->assertSeeText($food->carbohydrate)
            ->assertSeeText($food->sugar)
            ->assertSeeText($food->protein);
    }
}
