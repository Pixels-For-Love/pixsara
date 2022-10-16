<?php

namespace Database\Factories;

use App\Models\Charity;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Charity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true)

            //
        ];
    }
}
