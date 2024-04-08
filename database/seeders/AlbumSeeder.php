<?php

namespace Database\Seeders;

use App\Models\Ranking\Album;
use App\Models\Ranking\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::each(function ($level) {
            $level->albums()->saveMany(Album::factory(3)->make());
        });
    }
}
