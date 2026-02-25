<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(RentalDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function faceCapture()
    {
        return $this->hasOne(FaceCapture::class);
    }
}
