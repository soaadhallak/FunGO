<?php

namespace App\Http\Controllers\V1;

use App\Events\PlaceCreated;
use App\Filters\PlacesFilter;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\FilterRequest;
use App\Http\Requests\V1\GetSearchItemRequest;
use App\Http\Requests\v1\StorePlaceRequest;
use App\Http\Requests\V1\UpdatePlaceRequest;
use App\Http\Resources\PlaceForShowResource;
use App\Http\Resources\PlacePaginationResource;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;


class PlaceController extends Controller
{
    /**
     * ا
     */
    public function index()
    {
        //
    }

    /**
     * اضافة مكان جديد
     */
    public function store(StorePlaceRequest $request)
    {
        $place=Place::create($request->validated());
        if ($request->filled('activities')) {
            $place->activities()->attach($request->activities);
        }
        if ($request->hasFile('images')) {
            $place->addMultipleMediaFromRequest(['images'])
            ->each(function($fileAdder){
                $fileAdder->toMediaCollection('places');
            });
        }
        event(new PlaceCreated(
            $place,
            "add new place",
            "add new place",
            ['place_id'=>$place->id]
        ));
        return ApiResponse::getResponse(new PlaceResource($place->load(['activities','media'])),201,"تم إنشاء المكان");
          
    }
    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        $place->load(['activities','media','reviews','stories.media','stories.user']);
        return ApiResponse::getResponse(new PlaceForShowResource($place),200,'تم ارجاع المكان');
    }
    //update place
   public function update(UpdatePlaceRequest $request,Place $place){
    $place->update($request->validated());
    if($request->filled('activities')){
        $place->activities()->sync($request->activities);
    }
    if($request->hasFile('images')){
        $place->clearMediaCollection('places');
        foreach($request->file('images') as $image){
            $place->addMedia($image)->toMediaCollection('places');
        }
    }
    return ApiResponse::getResponse(new PlaceResource($place->load(['activities','media'])),200,'تم تعديل البيانات');

   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    //فلترة الاماكن
    public function filter(FilterRequest $request){
        $dataValidated=$request->validated();
        $query=Place::where('governorate',$dataValidated['governorate'])->whereHas('activities',function($q) use ($dataValidated){
                $q->where('activity_type_id',$dataValidated['activity_type_id']);})
                ->with(['media', 'reviews'])
                ->withAvg('reviews as avg_rating', 'rating')
                ->orderByDesc('avg_rating'); // الترتيب الافتراضي;
            
        
        $placeFilter=new PlacesFilter();
        $placeFilter->applyClosestFilter($query,$dataValidated);
        $placeFilter->applyCheapestFilter($query,$dataValidated);
        $placeFilter->applyOfferFilter($query,$dataValidated);

        $places=$query->paginate(10);
        if($places->total()>$places->perPage()){
            return ApiResponse::getResponse(PlacePaginationResource::collection($places)->response()->getData(true),200,'تم فلترة البيانات');
         }
            else{
             return ApiResponse::getResponse(PlacePaginationResource::collection($places),200,'تم فلترة البيانات');
            }
    }
    //البحث عن مكان معين
    public function search(GetSearchItemRequest $request){
        //update
        $word=$request->validated();
        $searchItem=$request->input('search');

        $places=Place::where('name','like','%'.$searchItem.'%')->orWhere('description','like','%'.$searchItem.'%')
        ->orwhere('address','like','%'.$searchItem.'%')->with(['media','reviews'])->paginate(10);

        if($places->total()>$places->perPage()){
            return ApiResponse::getResponse(PlacePaginationResource::collection($places)->response()->getData(true),
            200,
            'عرض نتائج البحث');
        }
        else{
            return ApiResponse::getResponse(PlacePaginationResource::collection($places)
            ,200,
            'تم عرض النتائج');
        }
        
    }
  
}    