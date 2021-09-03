<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::create([
            'name' => 'cheese',
        ]);

        Ingredient::create([
            'name' => 'pepperoni',
        ]);

        Ingredient::create([
            'name' => 'sausage',
        ]);

        Ingredient::create([
            'name' => 'pineapple',
        ]);

        Ingredient::create([
            'name' => 'green pepper',
        ]);

        Ingredient::create([
            'name' => 'pepperoni',
        ]);

        Ingredient::create([
            'name' => 'olives',
        ]);

        Ingredient::create([
            'name' => 'bacon',
        ]);

        Ingredient::create([
            'name' => 'canadian bacon',
        ]);
    }
}
