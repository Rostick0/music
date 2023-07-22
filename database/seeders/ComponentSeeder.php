<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $components = [
            [
                'name' => 'banner',
                'path' => 'banner'
            ],
            [
                'name' => 'main-banner',
                'path' => 'main-banner'
            ]
        ];

        foreach ($components as $component) {
            Component::create($component);
        }
    }
}
