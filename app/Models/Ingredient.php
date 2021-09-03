<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function deliveries()
    {
        return $this->belongsToMany(
            Delivery::class,
            'delivery_ingredients',
            'ingredient_id',
            'delivery_id'
        )->withTimestamps()->using( DeliveryIngredient::class )
            ->withPivot( 'received_at', 'is_fresh' );
    }
}
