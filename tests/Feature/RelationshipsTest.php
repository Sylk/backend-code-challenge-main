<?php

namespace Tests\Feature;

use App\Models\Delivery;
use App\Models\DeliveryIngredient;
use App\Models\Ingredient;
use App\Models\Restaurant;
use App\Models\RegionalManager;
use Database\Seeders\IngredientSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RelationshipsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that restaurants can be associated to a regional manager
     *
     * @return void
     */
    public function test_regional_manager_has_restaurants()
    {
        $regionalManager = RegionalManager::factory()
            ->has(Restaurant::factory()->count(3))
            ->create();

        $this->assertDatabaseCount('restaurants', 3);
        $this->assertDatabaseCount('regional_managers', 1);
        $this->assertEquals(3, $regionalManager->restaurants->count());
    }

    /**
     * Test that a restaurant belongs to a regional manager
     *
     * @return void
     */
    public function test_restaurant_belongs_to_regional_manager()
    {
        RegionalManager::factory()
            ->has(Restaurant::factory())
            ->create([
                'email' => 'test@pizza-planet.com'
            ]);

        $restaurant = Restaurant::first();
        $this->assertEquals('test@pizza-planet.com', $restaurant->regionalManager->email);
    }

    /**
     * Test that a restaurant has deliveries
     *
     * @return void
     */
    public function test_restaurant_has_deliveries()
    {
        RegionalManager::factory()
            ->has(Restaurant::factory()->has(Delivery::factory()->count(5)))
            ->create();

        $restaurant = Restaurant::first();
        $this->assertEquals( 5, $restaurant->deliveries->count() );
    }

    /**
     * Test that a delivery belongs to a restaurant
     *
     * @return void
     */
    public function test_delivery_belongs_to_restaurant()
    {
        RegionalManager::factory()
            ->has( Restaurant::factory()->has( Delivery::factory()->count( 5 ) )
                ->state( function ( array $attributes ) {
                    return [ 'name' => 'Test Restaurant Co.' ];
                } )
            )
            ->create();

        $delivery = Delivery::first();
        $this->assertEquals( 'Test Restaurant Co.', $delivery->restaurant->name );
    }

    public function test_ingredients_are_seeded()
    {
        $this->seed( IngredientSeeder::class );

        $pepperoni = Ingredient::where( 'name', 'pepperoni' )->first();
        $this->assertEquals('pepperoni', $pepperoni->name);
    }

    public function test_delivery_has_ingredients()
    {
        $this->seed( IngredientSeeder::class );
        $pepperoni = Ingredient::where( 'name', 'pepperoni' )->first();
        $sausage = Ingredient::where( 'name', 'sausage' )->first();

        RegionalManager::factory()
            ->has(Restaurant::factory()
                ->has(Delivery::factory())
            )->create();

        $delivery = Delivery::first();

        $this->assertEquals( 0, DeliveryIngredient::all()->count() );

        // Attach a delivery ingredient
        $delivery->ingredients()->sync( [
            $pepperoni->id => ['received_at' => now()],
            $sausage->id => ['received_at' => now()]
        ] );

        $delivery->refresh();
        $pepperoniObject = $delivery->ingredients()->where('name', 'pepperoni')->first();

        $this->assertEquals( 2, DeliveryIngredient::all()->count() );
        $this->assertNotNull($pepperoniObject);
        $this->assertInstanceOf('App\Models\Ingredient', $pepperoniObject);
        $this->assertEquals('pepperoni', $pepperoniObject->name);
        $this->assertEquals(now()->format('Y-m-d'), $pepperoniObject->pivot->received_at->format('Y-m-d'));
    }

    public function test_ingredient_has_delivery()
    {
        $this->seed( IngredientSeeder::class );
        $pepperoni = Ingredient::where( 'name', 'pepperoni' )->first();

        RegionalManager::factory()
            ->has(Restaurant::factory()
                ->has(Delivery::factory())
            )->create();

        $delivery = Delivery::first();

        $this->assertEquals( 0, DeliveryIngredient::all()->count() );
        $this->assertEquals(0, $pepperoni->deliveries->count());

        // Attach a delivery ingredient
        $delivery->ingredients()->attach($pepperoni->id, ['received_at' => now()]);

        $pepperoni->refresh();

        $this->assertEquals(1, $pepperoni->deliveries->count());
    }
}
