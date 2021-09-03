<?php

namespace Database\Factories;

use App\Models\DeliveryIngredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryIngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryIngredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'delivery_id' => 1,
            'ingredient_id' => 1,
            'received_at' => $this->faker->dateTimeBetween( now()->subWeek(), now() ),
            'is_fresh' => $this->faker->boolean,
        ];
    }
}
