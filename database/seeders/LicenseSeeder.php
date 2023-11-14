<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $music = Music::find(1);

        $music->licenses()->create([
            'user_id' => 2,
            'code' => 'A85B-CD4154-E1245',
        ]);
    }
}
