<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::insert([
            ['name' => 'adventures'],
            ['name' => 'historical'],
            ['name' => 'science'],
            ['name' => 'romance'],
            ['name' => 'fantacy'],
            ['name' => 'self-help']
        ]);
    }
}
