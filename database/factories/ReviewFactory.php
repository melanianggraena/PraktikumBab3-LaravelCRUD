<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        // Distribusi rating:
        // 40% => 5
        // 30% => 4
        // 20% => 3
        // 10% => 1-2

        $random = rand(1, 100);

        if ($random <= 40) {
            $rating = 5;
        } elseif ($random <= 70) {
            $rating = 4;
        } elseif ($random <= 90) {
            $rating = 3;
        } else {
            $rating = rand(1, 2);
        }

        return [
            'user_id' => User::query()
                ->inRandomOrder()
                ->value('id'),

            'product_id' => Product::query()
                ->inRandomOrder()
                ->value('id'),

            'rating' => $rating,

            'comment' => fake()->sentence(15),
        ];
    }
}
