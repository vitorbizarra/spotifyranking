<?php

namespace Database\Seeders;

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
        Tierlist::factory(3)->create();
    }
}
