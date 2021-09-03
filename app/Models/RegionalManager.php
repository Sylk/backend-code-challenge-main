<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalManager extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function restaurants()
    {
        return $this->hasMany( Restaurant::class );
    }

}