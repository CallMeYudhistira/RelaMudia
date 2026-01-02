<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultimediaItem extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'price_per_day',
        'stock',
        'status',
        'image',
    ];

    public function rentalDetails()
    {
        return $this->hasMany(RentalDetail::class);
    }
}
