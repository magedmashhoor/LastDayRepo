<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHealthFacilityRequest extends FormRequest
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
            'facility_name'        => 'required|string|max:255',
            'facility_type'        => 'required|string|max:100',
            'address'              => 'required|string',
            'governorate_id'       => 'required|exists:governorates,id',
            'district_id'          => 'required|exists:districts,id',
            'phone_number_1'       => 'nullable|string|max:20',
            'phone_number_2'       => 'nullable|string|max:20',
            'whatsapp_number'      => 'nullable|string|max:20',
            'responsible_user_id'  => 'nullable|exists:users,id',
        ];
    }
    public function messages(): array
{
    return [
        'facility_name.required'        => 'اسم المنشأة مطلوب.',
        'facility_name.string'          => 'يجب أن يكون اسم المنشأة نصاً.',
        'facility_type.required'        => 'نوع المنشأة مطلوب.',
        'facility_type.string'          => 'يجب أن يكون نوع المنشأة نصاً.',
        'address.required'              => 'العنوان مطلوب.',
        'address.string'                => 'يجب أن يكون العنوان نصاً.',
        'governorate_id.required'       => 'المحافظة مطلوبة.',
        'governorate_id.exists'         => 'المحافظة المحددة غير موجودة.',
        'district_id.required'          => 'المديرية مطلوبة.',
        'district_id.exists'            => 'المديرية المحددة غير موجودة.',
        'phone_number_1.string'         => 'يجب أن يكون رقم الهاتف نصاً.',
        'phone_number_1.max'            => 'رقم الهاتف الأول طويل جداً.',
        'phone_number_2.string'         => 'يجب أن يكون رقم الهاتف الثاني نصاً.',
        'phone_number_2.max'            => 'رقم الهاتف الثاني طويل جداً.',
        'whatsapp_number.string'        => 'يجب أن يكون رقم الواتساب نصاً.',
        'whatsapp_number.max'           => 'رقم الواتساب طويل جداً.',
        'responsible_user_id.exists'    => 'المستخدم المسؤول غير موجود.',
    ];
}
}
