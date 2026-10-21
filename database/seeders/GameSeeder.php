<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GamesLibrary;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        GamesLibrary::create([
            'category' => 'PC',
            'tag' => 'ЭКСКЛЮЗИВ',
            'name' => 'Counter-Strike 2',
            'description' => 'Легендарный тактический шутер.',
            'rating' => '9.5',
            'state' => 'Установлено',
            'image' => 'counter-strike-2.jpg',
        ]);

        GamesLibrary::create([
            'category' => 'PC, PS5',
            'tag' => 'ДОСТУПНО',
            'name' => 'Cyberpunk 2077',
            'description' => 'Ролевая игра в мире будущего.',
            'rating' => '9.0',
            'state' => 'Установлено',
            'image' => 'cyberpunk-2077.jpg',
        ]);

        GamesLibrary::create([
            'category' => 'PC, PS5',
            'tag' => 'ДОСТУПНО',
            'name' => 'EA Sports FC 25',
            'description' => 'Симулятор футбола.',
            'rating' => '8.5',
            'state' => 'Установлено',
            'image' => 'ea-sports-fc-25.jpg',
        ]);
    }
}