<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Place extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\PlaceFactory> */
    use HasFactory,InteractsWithMedia;
    public function trips(){
        return $this->belongsToMany(Trip::class,'trip_place')->withPivot('min_price','max_price')->withTimestamps();
    }
    public function activities(){
        return $this->belongsToMany(ActivityType::class,'place_activity');
    }
    public function sales(){
        return $this->hasMany(Sale::class);
    }
    public function stories(){
        return $this->hasMany(Story::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
