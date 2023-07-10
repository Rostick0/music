<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    private $notices = [
        [
            'type' => 'remove_claim',
            'type_id' => 1
        ],
        [
            'type' => 'remove_claim',
            'type_id' => 2
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->notices as $notice) {
            Notice::firstOrCreate($notice);
        }
    }
}
