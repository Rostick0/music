<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    private $genres = [
        'classical',
        'opera',
        'jazz',
        'soul',
        'blues',
        'house',
        'rap',
        'techno',
        'rock',
        'pop',
        'heavy metal',
        'country',
        'folk',
        'reggae',
        'world music',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->genres as $genre) {
            Genre::firstOrCreate([
                'name' => $genre
            ]);
        }
    }
}
