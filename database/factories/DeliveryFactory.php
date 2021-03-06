<?php

namespace Database\Factories;

use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_id' => 1,
            'delivered_at' => $this->faker->dateTimeBetween( now()->subWeek(), now() ),
        ];
    }
}
