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
     * @group product
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

    /**
     * @group product
     */
    public function test_name_is_required(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $name = '';
        $sku = '5';
        $description = 'Test description product';
        $specification = 'Test specification product';

        $response = $this->post('/products', [
            'name' => $name,
            'sku' => $sku,
            'description' => $description,
            'specification' => $specification,
        ]);

        $this->assertCount(0, $user->currentTeam->fresh()->products);
    }

    /**
     * @group product
     */
    public function test_user_role_cant_update_product(): void
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->products()->save($product = Product::factory()->make());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'user']
        );
        
        $this->actingAs($otherUser);
        $otherUser->switchTeam($user->currentTeam);
        
        $response = $this->put('/products/'.$product->id, [
            'name' => $product->name . " updated",
            'sku' => '6',
            'description' => $product->description . " updated",
            'specification' => $product->specification . " updated",
        ]);

        $this->assertEquals($product->name, $product->fresh()->name);
        $this->assertEquals($product->sku, $product->fresh()->sku);
        $this->assertEquals($product->description, $product->fresh()->description);
        $this->assertEquals($product->specification, $product->fresh()->specification);
    }
}
