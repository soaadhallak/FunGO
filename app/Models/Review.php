<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //



    public function place(){
        return $this->belongsTo(Place::class);
    }
    public function activityType(){
        return $this->belongsTo(ActivityType::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
