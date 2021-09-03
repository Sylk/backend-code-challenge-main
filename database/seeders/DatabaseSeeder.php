<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\DeliveryIngredient;
use App\Models\Ingredient;
use App\Models\Restaurant;
use App\Models\RegionalManager;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call( IngredientSeeder::class );

        // Create Owners
        $regionalManager1 = RegionalManager::create([
            'name' => 'Big Al',
            'email' => 'al@pizzaplanet.com',
            'region' => 'WESTERN-US'
        ]);

        $regionalManager2 = RegionalManager::create([
            'name' => 'Ted',
            'email' => 'ted@pizzaplanet.com',
            'region' => 'EASTERN-US'
        ]);

        // Create Restaurants
        Restaurant::factory()->count( 50 )->create([
            'regional_manager_id' => $regionalManager1->id
        ]);

        Restaurant::factory()->count( 50 )->create([
            'regional_manager_id' => $regionalManager2->id
        ]);

        $allRestaurants = Restaurant::all();
        $ingredients = Ingredient::all();
        // Create Deliveries for the past week
        for ( $i = 0; $i <= 7; $i++ ) {
            $date = now()->subDays( 7 - $i );

            $allRestaurants->each( function ( $restaurant ) use ( $date, $ingredients ) {
                $dailyDelivery = Delivery::create([
                    'restaurant_id' => $restaurant->id,
                    'delivered_at' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                // Ingredients that were part of delivery
                $ingredients->each( function ( $ingredient ) use ( $dailyDelivery, $date ) {
                    $dailyDelivery->ingredients()->attach($ingredient->id, [
                        'received_at' => $date,
                        'created_at' => $date,
                        'updated_at' => $date,
                        'is_fresh' => true
                    ]);
                });
            });
        }

        $unusableDeliveryIngredientsIds = config('unusable-items');
        DeliveryIngredient::whereIn( 'id', $unusableDeliveryIngredientsIds )->update([
            'is_fresh' => false
        ]);
    }
}
