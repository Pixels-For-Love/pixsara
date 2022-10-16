<?php

namespace Database\Seeders;

use App\Models\Charity;
use Illuminate\Database\Seeder;

class CharitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Starter Charities
        Charity::factory()->create(["name"=>"Battered Women Fund"]);
        Charity::factory()->create(["name"=>"Wounded Warrior Project"]);

        Charity::factory()->count(20)->create();

    }
}
