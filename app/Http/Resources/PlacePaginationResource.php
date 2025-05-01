<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlacePaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'rating' => $this->avg_rating ? number_format($this->avg_rating, 1) : 'جديد',
            'image'=>$this->getFirstMediaUrl('places'),
            'address'=>$this->address,
            'price'=>$this->when(isset($this->cheapest_price),function(){
                return $this->cheapest_price;
            }),
        ];
    }
}
