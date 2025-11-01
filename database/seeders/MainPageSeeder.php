<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MainPage;

class MainPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainPage::updateOrCreate(
            ['id' => 1],
            [
                'banner_text' => 'Embrace the extraordinary.<br/>Live your fullest life.',
                'moto' => 'Connecting brands & people through experiences.',
                'experience' => 11,
                'projects' => 10,
                'certification' => 6,
                'article' => 3, 
                'books' => 1,
                'mentoring' => 15,
            ]
        );
    }
}
