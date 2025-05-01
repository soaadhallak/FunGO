<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    //هي كرمال ال store
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'address'=>$this->address,
            'description'=>$this->description,
            'governorate'=>$this->governorate,
            'location'=>[
                'longitude'=>$this->longitude,
                'latitude'=>$this->latitude,
            ],
            'activities'=>ActivityInPlaceResource::collection($this->whenloaded('activities')),
            'images'=>$this->whenLoaded('media',function(){
                return $this->getMedia('places')->map(function($media){
                    return[
                        'original'=>$media->getUrl(),
                    ];
                });
            })

        ];
    }
}
