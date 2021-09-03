<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DeliveryIngredient extends Pivot
{
    use HasFactory;

    protected $table = 'delivery_ingredients';

    protected $guarded = [];

    protected $dates = ['received_at'];
}
