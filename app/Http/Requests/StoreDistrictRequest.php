<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistrictRequest extends FormRequest
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
   public function rules()
{
    return [
        'district_name' => 'required|string|max:50|unique:districts,district_name,' . $this->route('id'),
        'governorate_id' => 'required|exists:governorates,id',
    ];
}

public function messages()
{
    return [
        'district_name.required' => 'اسم المديرية مطلوب.',
        'district_name.string'   => 'اسم المديرية يجب أن يكون نصًا.',
        'district_name.max'      => 'اسم المديرية لا يجب أن يتجاوز 50 حرف.',
        'district_name.unique'   => 'اسم المديرية موجود مسبقًا.',
        'governorate_id.required' => 'يرجى اختيار المحافظة.',
        'governorate_id.exists'   => 'المحافظة المحددة غير صحيحة.',
    ];
}
}
