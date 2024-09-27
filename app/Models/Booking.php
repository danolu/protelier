<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    use HasFactory;
        
    protected $guarded = [];

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withTimestamps();
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
