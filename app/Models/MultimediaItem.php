<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class MultimediaItem extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price_per_day',
        'image',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>
                $value
                    ? asset('image/items/' . $value)
                    : asset('image/items/default.png')
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function rentalDetails()
    {
        return $this->hasMany(RentalDetail::class);
    }
}
