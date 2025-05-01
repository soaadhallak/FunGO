<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Place extends Model implements HasMedia
{
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'description',
        'governorate',
    ];
    /** @use HasFactory<\Database\Factories\PlaceFactory> */
    use HasFactory,InteractsWithMedia;
    public function trips(){
        return $this->belongsToMany(Trip::class,'trip_place');
    }
    public function activities(){
        return $this->belongsToMany(ActivityType::class,'place_activity')->withPivot('min_price','max_price')->withTimestamps();
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
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('places')->useDisk('places');
    }
}
