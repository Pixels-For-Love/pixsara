<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Classes\Canvas;
use App\Models\CanvasImagePixel;


class CanvasImagePixelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for($x = 1; $x<5; $x++){
            for($y=1; $y<5; $y++){
                CanvasImagePixel::factory()
                    ->create([
                        'pos_x'=> $x,
                        'pos_y'=> $y,
                        'color' => Canvas::getRandomColor(),
                        'user_id' => rand(1,6), // assign to a random user, 10 seeded
                        'charity_id' => rand(1,3) // assign to random charity 1,2 hardcoded through seeder 20 random
                        ]);
            }
        }



    }
}
