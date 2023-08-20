<?php

namespace Database\Seeders;

use App\Models\RemoveClaim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RemoveClaimSeeder extends Seeder
{
    public function run(): void
    {
        $remove_claims = [
            [
                'link' => 'https://www.youtube.com/watch?v=3hAMKCcM4tE',
                'user_id' => 1,
                'music_id' => 1
            ],
            [
                'link' => 'https://www.youtube.com/watch?v=7nFspOuD0ZY',
                'user_id' => 2,
                'music_id' => 2
            ]
        ];

        foreach ($remove_claims as $remove_claim) {
            RemoveClaim::firstOrCreate($remove_claim);
        }
    }
}
