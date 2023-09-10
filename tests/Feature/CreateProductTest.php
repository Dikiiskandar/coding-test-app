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
     * @group product
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
        $this->assertEquals($sku, $user->currentTeam->fresh()->products()->latest('id')->first()->sku);
        $this->assertEquals($description, $user->currentTeam->fresh()->products()->latest('id')->first()->description);
        $this->assertEquals($specification, $user->currentTeam->fresh()->products()->latest('id')->first()->specification);
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
    public function test_user_role_cant_create_product(): void
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'user']
        );
        
        $this->actingAs($otherUser);
        $otherUser->switchTeam($user->currentTeam);
        
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
        
        $this->assertCount(0, $user->currentTeam->fresh()->products);
        $response->assertStatus(401);
    }
}
