<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::factory()
            ->count(300)
            ->create();

        $this->command->info('300 review berhasil dibuat.');
    }
}
