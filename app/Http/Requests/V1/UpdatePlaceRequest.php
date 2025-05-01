<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['sometimes','string','max:25'],
            'address'=>['sometimes','string','max:50'],
            'description'=>['sometimes','string','max:255'],
            'latitude'=>['sometimes','numeric','between:-90,+90'],
            'longitude'=>['sometimes','numeric','between:-180,+180'],
            'governorate'=>['sometimes','string'],
            //رفع الصور
            'images'=>['sometimes','array'],
            'images.*'=>['image','mimes:jpeg,png,jpg,gif','max:2048'],
            //الانشطة
            'activities'=>['sometimes','array'],
            'activities.*.activity_type_id'=>['sometimes','exists:activity_types,id'],
            'activities.*.min_price'=>['sometimes','numeric','min:0'],
            'activities.*.max_price'=>['sometimes','numeric','gte:activities.*.min_price','min:0'],
        ];
    }
}
