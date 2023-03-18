<?php

namespace Database\Factories;

use App\Models\CanvasImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CanvasImage>
 */
class CanvasImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $p = '';
        foreach($this->faker->paragraphs(rand(2,6)) as $paragraph){
            $p .= $paragraph . "\r\n\r\n";
        }

        $p = trim($p);

        return [
            'title' => $this->faker->sentence(5),
            'slug' => $this->faker->slug(),
            'description' => $p,
            'width' => CanvasImage::DEFAULT_WIDTH,
            'height' => CanvasImage::DEFAULT_HEIGHT,
            //
        ];
    }
}
