<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImportTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function import()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
