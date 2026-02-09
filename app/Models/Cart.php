<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'multimedia_item_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function multimediaItem()
    {
        return $this->belongsTo(MultimediaItem::class);
    }
}
