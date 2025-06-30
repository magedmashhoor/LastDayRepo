<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'doctor_name'          => 'required|string|max:255',
            'gender'               => 'required|string',
            'specialty_id'         => 'required|exists:specialties,id',
            'subspecialty_id'      => 'nullable|exists:subspecialties,id',
            'qualification_degree' => 'nullable|string|max:100',
            'bio'                  => 'nullable|string|max:1000',
            'governorate_id'       => 'required|exists:governorates,id',
            'district_id'          => 'required|exists:districts,id',
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_name.required'       => 'اسم الطبيب مطلوب.',
            'gender.required'            => 'الجنس مطلوب.',
            'specialty_id.required'      => 'يجب اختيار التخصص.',
            'specialty_id.exists'        => 'التخصص غير موجود.',
            'subspecialty_id.exists'     => 'التخصص الفرعي غير موجود.',
            'qualification_degree.string' => 'يجب أن تكون الدرجة العلمية نصاً.',
            'bio.string'                 => 'يجب أن تكون النبذة نصاً.',
            'governorate_id.required'    => 'يجب اختيار المحافظة.',
            'governorate_id.exists'      => 'المحافظة المحددة غير موجودة.',
            'district_id.required'       => 'يجب اختيار المديرية.',
            'district_id.exists'         => 'المديرية المحددة غير موجودة.',
        ];
    }
}
