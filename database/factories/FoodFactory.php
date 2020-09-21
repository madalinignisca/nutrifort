<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use FakerRestaurant\Provider\en_US\Restaurant;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Food::class;

    public function __construct()
    {
        parent::__construct();

        $this->faker->addProvider(new Restaurant($this->faker));
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->foodName(),
            'fat' => $fat = $this->faker->randomFloat(2, 0, 100),
            'saturated_fat' => $this->faker->randomFloat(2, 0, $fat),
            'carbohydrate' => $carbohydrate = $this->faker->randomFloat(2, 0, 100 - $fat),
            'sugar' => $this->faker->randomFloat(2, 0, $carbohydrate),
            'protein' => $this->faker->randomFloat(2, 0, 100 - $fat - $carbohydrate),
            'animal' => $this->faker->boolean,
        ];
    }
}
