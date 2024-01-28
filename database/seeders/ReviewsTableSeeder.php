<?php

// database/seeders/ReviewsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Barang;
use App\Models\User;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // Assuming you have some products (barang) and users in the database

        $barangIds = Barang::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        foreach ($barangIds as $barangId) {
            Review::factory()->create([
                'barang_id' => $barangId,
                'user_id' => $userIds[array_rand($userIds)],
                'rating' => rand(1, 5),
                'comment' => 'Sample review comment.',
            ]);
        }
    }
}
