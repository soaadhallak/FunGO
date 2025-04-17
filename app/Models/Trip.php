<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function places(){
        return $this->belongsToMany(Place::class,'trip_place');
    }
}
