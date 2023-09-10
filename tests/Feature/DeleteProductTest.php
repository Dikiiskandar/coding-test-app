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
     * @group product
     */
    public function test_products_can_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $user->currentTeam->products()->save($product = Product::factory()->make());

        $response = $this->delete('/products/'.$product->id);

        $this->assertNull($product->fresh());
        $this->assertCount(0, $user->currentTeam->fresh()->products);
    }

    /**
     * @group product
     */
    public function test_user_role_cant_delete_product(): void
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->products()->save($product = Product::factory()->make());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'user']
        );
        
        $this->actingAs($otherUser);
        $otherUser->switchTeam($user->currentTeam);
        
        $response = $this->delete('/products/'.$product->id);

        $this->assertNotNull($product->fresh());
        $this->assertCount(1, $user->currentTeam->fresh()->products);
    }
}
