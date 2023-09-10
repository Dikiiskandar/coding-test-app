<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_products_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $user->currentTeam->products()->save($product = Product::factory()->make());

        $response = $this->put('/products/'.$product->id, [
            'name' => $product->name . " updated",
            'sku' => '6',
            'description' => $product->description . " updated",
            'specification' => $product->specification . " updated",
        ]);

        $this->assertEquals($product->name . " updated", $product->fresh()->name);
        $this->assertEquals('6', $product->fresh()->sku);
        $this->assertEquals($product->description . " updated", $product->fresh()->description);
        $this->assertEquals($product->specification . " updated", $product->fresh()->specification);
    }
}
