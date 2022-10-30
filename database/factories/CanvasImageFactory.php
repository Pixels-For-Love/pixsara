<?php

namespace Database\Factories;

use App\Models\CanvasImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class CanvasImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CanvasImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $p = '';
        foreach($this->faker->paragraphs(rand(2,6)) as $paragraph){
            $p .= $paragraph . "\r\n\r\n";
        }

        $p = trim($p);

        return [
            'title' => $this->faker->sentence(5),
            'slug' => $this->faker->slug(),
            'width' => 500,
            'height' => 500,
            'description' => $p,

            //
        ];
    }
}
