<?php

namespace Database\Seeders;

use App\Models\CanvasImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CanvasImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        CanvasImage::factory()->count(5)
            ->create(['user_id' =>rand(1,1)]);

        CanvasImage::factory()->count(5)
            ->create(['user_id' =>rand(0,5)]);


    }
}
