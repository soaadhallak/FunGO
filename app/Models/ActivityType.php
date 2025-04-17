<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    //
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function places(){
        return $this->belongsToMany(Place::class,'place_activity')->withPivot('min_price','max_price')->withTimestamps();
    }
}
