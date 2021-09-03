<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function regionalManager()
    {
        return $this->belongsTo( RegionalManager::class );
    }

    public function deliveries()
    {
        return $this->hasMany( Delivery::class );
    }
}
