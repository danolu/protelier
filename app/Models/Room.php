<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class)->withTimestamps();
    }

}
