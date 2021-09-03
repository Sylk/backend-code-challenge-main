<?php

namespace App\Mail;

use App\Models\RegionalManager;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IngredientsWeeklyReport extends Mailable
{
    use Queueable, SerializesModels;

    public $manager;
    public $restaurants = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RegionalManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // * Restaurant's number and name concatenated
        // * Total number of fresh ingredients
        // * Total number of non-fresh ingredients
        // * Percentage of ingredients that were fresh
        // * List of all the unique ingredient names that where not fresh for each restaurant

        //      restaurants [
        //          'fresh ingredients total': int
        //          'non-fresh ingredients total': int
        //          'percentage fresh': int
        //          'non-fresh ingredients unique': array

        foreach($this->manager->restaurants as $restaurant) {
            $currentRestaurant = [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'fresh-ingredients-total' => 0,
                'non-fresh-ingredients-total' => 0,
                'percentage-fresh' => 0,
                'non-fresh-ingredients-unique' => []
            ];

            // Now we need to check each restaurants deliveries
            foreach($restaurant->deliveries as $delivery) {
                // Now we need to check every ingredient on those deliveries
                foreach($delivery->ingredients as $ingredient) {
//                    dd($ingredient->pivot->is_fresh);
                    if($ingredient->pivot->is_fresh == 1) {
                        $currentRestaurant['fresh-ingredients-total']++;
                    } else {
                        $currentRestaurant['non-fresh-ingredients-total']++;
                        array_push($currentRestaurant['non-fresh-ingredients-unique'], $ingredient->name);
                    }
                }
            }

            // Calculate the percentage of fresh ingredients
            $totalIngredients = $currentRestaurant['fresh-ingredients-total'] + $currentRestaurant['non-fresh-ingredients-total'];
            $currentRestaurant['percentage-fresh'] =  ceil(100 * ($currentRestaurant['fresh-ingredients-total'] / $totalIngredients));

            // Just remove all non-unique values instead of comparing it each iteration
            $currentRestaurant['non-fresh-ingredients-unique'] = array_unique($currentRestaurant['non-fresh-ingredients-unique']);

            // Add this to the list of restaurants we have
            array_push($this->restaurants, $currentRestaurant);
        }

        return $this
            ->from('example@example.com', 'Example')
            ->view('mailable.ingredients-weekly-report');
    }
}
