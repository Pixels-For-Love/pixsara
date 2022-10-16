<?php

namespace Database\Factories;

use App\Models\CanvasImagePixel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CanvasImagePixelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CanvasImagePixel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types=['charity','tesla'];


        return [

            'canvas_image_id' => 1,
            'user_id' => 1,
            'pos_x' => rand(0, 500),
            'pos_y' => rand(0, 500),
            'color' => \App\Classes\Canvas::getRandomColor(),
            'title' => substr($this->faker->sentence(5),1,50),
            'reward' => $types[rand(0,1)]
            //
        ];
    }
}
