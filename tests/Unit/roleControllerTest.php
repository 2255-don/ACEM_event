<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Role;
use Mockery;

class roleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

     /** @test */
    public function Role_return_index(): void
    {
        $payload = (object)['id' => 1, 'nom' => 'Admin'];

        Role::shouldReceive('All')
            ->once()
            ->andReturn(collect([$payload]));

        $response = $this->get('/role');

        $response->assertOk()
                 ->assertViewIs('role.index')
                 ->assertViewHas('role', fn($c) => $c->first()->nom == 'Admin');
    }
}
