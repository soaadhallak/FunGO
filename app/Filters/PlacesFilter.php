<?php
namespace App\Filters;

use App\Models\Place;
use Illuminate\Support\Facades\DB;

class PlacesFilter{




    //فلترة حسب العروض
    public function applyOfferFilter($query, array $validated){
        if(!empty($validated['filters']['has_offer'])){
            $query->whereHas('sales',function($q){
                $q->where('date_start','<=',now())->where('date_end','>=',now());
            });
            return $this;
        }
    }

    //فلترة حسب الارخص
    public function applyCheapestFilter($query, array $validated){
        if(!empty($validated['filters']['cheapest'])){

            $query->addSelect([
                'cheapest_price' => DB::table('place_activity')
                    ->selectRaw('MIN(min_price)')
                    ->whereColumn('place_id', 'places.id')
                    ->where('activity_type_id', $validated['activity_type_id'])
            ])
            ->reorder() // مسح الترتيب السابق
            ->orderBy('cheapest_price')
            ->orderByDesc('avg_rating'); // الترتيب الثانوي
        }else{
            $query->with(['activities']);
        }
        return $this;
    }
    //فلترة حسب الأقرب
    public function applyClosestFilter($query, array $validated){
        if (!empty($validated['filters']['closest']) && isset($validated['user_location'])) {
            $lat = $validated['user_location']['latitude'];
            $lng = $validated['user_location']['longitude'];
            $query->addSelect('places.*');
            $query->addSelect(DB::raw(
                "ST_Distance_Sphere(POINT(longitude, latitude), POINT($lng, $lat)) as distance"
            )) 
            ->reorder() // مسح الترتيب السابق
            ->orderBy('distance')
            ->orderByDesc('avg_rating');;
        }
        return $this;
    }
}