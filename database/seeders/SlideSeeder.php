<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'name' => 'canon',
                'image' => 'canon-slide.svg',
            ],
            [
                'name' => 'coca-cola',
                'image' => 'coca-cola-slide.svg'
            ],
            [
                'name' => 'dr-berg',
                'image' => 'dr-berg-slide.svg'
            ],
            [
                'name' => 'lays',
                'image' => 'lays-slide.svg'
            ],
            [
                'name' => 'samsung',
                'image' => 'samsung-slide.svg'
            ],
            [
                'name' => 'starbucks',
                'image' => 'starbucks-slide.svg'
            ]
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
