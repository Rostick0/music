<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    private $themes = [
        'adventure',
        'business',
        'cooking',
        'creative',
        'drama',
        'education',
        'empowering',
        'family',
        'fantasy',
        'filming',
        'freedom',
        'lifestyle',
        'nature',
        'patriotic',
        'podcast',
        'racing',
        'science',
        'stylish',
        'technology',
        'unboxing',
        'vintage',
        'workout',
    ];

    public function run(): void
    {
        foreach ($this->themes as $theme) {
            Theme::firstOrCreate([
                'name' => $theme
            ]);
        }
    }
}
