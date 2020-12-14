<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Food;

class PlaygroundTest extends TestCase
{
    use RefreshDatabase;

    public function testTrue()
    {
        $this->assertTrue(true);
    }
}
