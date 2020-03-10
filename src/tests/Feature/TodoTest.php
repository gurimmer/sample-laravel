<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * @test
     */
    public function index_アクセスできること()
    {
        $this->get(route('todos.index'))
            ->assertStatus(200);
    }
}
