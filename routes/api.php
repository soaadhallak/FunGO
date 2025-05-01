<?php

use App\Http\Controllers\V1\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//route for place controller
Route::prefix('/places')->group(function(){

    //route for filtering
    Route::post('{place}/update',[PlaceController::class,'update']);

    //route for searching
    Route::get('search',[PlaceController::class,'search']);

    //special updae route
    Route::post('filter', [PlaceController::class, 'filter']);
    
    Route::apiResource('/',PlaceController::class);
});