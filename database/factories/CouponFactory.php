<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'code' => strtoupper(fake()->unique()->bothify('DISC-####')),
        'discount_type' => fake()->randomElement(['percent', 'fixed']),
        'discount_value' => fake()->numberBetween(5, 50),
        'min_order' => fake()->numberBetween(50000, 500000),
        'expires_at' => fake()->dateTimeBetween('-1 month', '+3 months'),
        'usage_limit' => fake()->numberBetween(10, 500),
        'used_count' => fake()->numberBetween(0, 300),
    ];
}
}
