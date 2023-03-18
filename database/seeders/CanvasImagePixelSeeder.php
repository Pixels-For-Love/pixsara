<?php

namespace Database\Seeders;

use App\Classes\ImageCanvas;
use App\Models\CanvasImagePixel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CanvasImagePixelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        for($x = 1; $x<5; $x++){
            for($y=1; $y<5; $y++){
                CanvasImagePixel::factory()
                    ->create([
                        'canvas_image_id' => 1,
                        'pos_x'=> $x,
                        'pos_y'=> $y,
                        'color' => getRandomColor(),
                        'user_id' => rand(1,6), // assign to a random user, 10 seeded
//                        'charity_id' => rand(1,3) // assign to random charity 1,2 hardcoded through seeder 20 random
                    ]);
            }
        }
    }
}
