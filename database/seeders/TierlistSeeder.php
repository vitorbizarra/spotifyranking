<?php

namespace Database\Seeders;

use App\Models\Ranking\Album;
use App\Models\Ranking\Level;
use App\Models\Ranking\Tierlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TierlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tierlist::factory(3)->create()->each(function ($tierlist) {
            Album::inRandomOrder()->limit(5)->get()->each(function ($album) use ($tierlist) {
                $tierlist->albums()->attach($album->id, ['level_id' => Level::inRandomOrder()->first()->id]);
            });
        });
    }
}
