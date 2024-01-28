<?php

// database/factories/ReviewFactory.php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'barang_id' => $this->faker->numberBetween(1, 10), // Assuming 10 products
            'user_id' => $this->faker->numberBetween(1, 20),   // Assuming 20 users
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph,
        ];
    }
}

