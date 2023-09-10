<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_products_can_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $user->currentTeam->products()->save($product = Product::factory()->make());

        $response = $this->delete('/products/'.$product->id);

        $this->assertNull($product->fresh());
        $this->assertCount(0, $user->currentTeam->fresh()->products);
    }
}
