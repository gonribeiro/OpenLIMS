<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAccessTheIndexPage()
    {
        $response = $this->get('/');

        $response->assertViewIs('user.index');
    }
}
