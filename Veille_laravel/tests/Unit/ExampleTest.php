<?php

namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use App\Models\Categorie;
use App\Http\Controllers\Controller;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_show_categorie(): void
    {
        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
    }

    public function test_show_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.index');
    }
}

// class TestRoute extends TestCase
// {
    
// }
