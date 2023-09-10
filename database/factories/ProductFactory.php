<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'team_id' => Team::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->word() . ' Product',
            'sku' => $this->faker->numberBetween(1, 20),
            'description' => $this->faker->text(),
            'specification' => $this->faker->text(),
            'photo_path' => ""
        ];
    }
}
