<?php

namespace Database\Factories;

use App\Models\RegionalManager;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionalManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RegionalManager::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'region' => $this->faker->randomElement(['WESTERN-US', 'EASTERN-US'])
        ];
    }
}
