<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'description' => ['required', 'string', 'max:255'],
            'governorate' => ['required', 'string'],
        
            // رفع الصور المتعددة
            'images' => ['required', 'array','min:1','max:10'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        
            // ربط الأنشطة
            'activities' => ['required', 'array'],
            'activities.*.activity_type_id' => ['required','exists:activity_types,id'],
            'activities.*.min_price' => ['required', 'numeric'],
            'activities.*.max_price' => ['required', 'numeric', 'gt:activities.*.min_price'],
        ];
    }
}
