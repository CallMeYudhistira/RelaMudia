<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceCapture extends Model
{
    protected $fillable = [
        'rental_id',
        'face_image',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
