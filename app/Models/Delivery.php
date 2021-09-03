<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function restaurant()
    {
        return $this->belongsTo( Restaurant::class );
    }

    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredient::class,
            'delivery_ingredients',
            'delivery_id',
            'ingredient_id'
        )->withTimestamps()->using( DeliveryIngredient::class )
            ->withPivot( 'received_at', 'is_fresh' );
    }
}
