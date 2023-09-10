<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_products_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $name = 'Test Unit Product';
        $sku = '5';
        $description = 'Test description product';
        $specification = 'Test specification product';

        $response = $this->post('/products', [
            'name' => $name,
            'sku' => $sku,
            'description' => $description,
            'specification' => $specification,
        ]);

        $this->assertCount(1, $user->currentTeam->fresh()->products);
        $this->assertEquals($name, $user->currentTeam->fresh()->products()->latest('id')->first()->name);
    }
}
