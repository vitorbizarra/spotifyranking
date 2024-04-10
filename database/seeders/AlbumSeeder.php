<?php

namespace Database\Seeders;

use App\Models\Ranking\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Album::factory(20)->create();
    }
}
