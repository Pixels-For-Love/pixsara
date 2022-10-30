<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Models\CanvasImage;
use App\Models\CanvasImagePixel;

class CanvasImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        CanvasImage::factory()->count(5)
            ->create(['user_id' =>rand(1,1)]);

        CanvasImage::factory()->count(5)
            ->create(['user_id' =>rand(0,5)]);


    }
}
