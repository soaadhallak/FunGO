<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'governorate'=>['required','string'],
            'filters'=>['sometimes','array'],
            'filters.closest'=>['nullable','boolean'],
            'filters.cheapest'=>['nullable','boolean'],
            'filters.has_offer'=>['nullable','boolean'],
            'user_location'=>['required-if:filters.closest,true','array'],
            'user_location.latitude' => ['required-with:user_location','numeric','between:-90,90'],
            'user_location.longitude' => ['required-with:user_location','numeric','between:-180,+180'],
            'activity_type_id'=>['required','exists:activity_types,id'],
        ];
    }
}
