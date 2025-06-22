<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubspecialtyRequest extends FormRequest
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
        'subspecialty_name' => 'required|string|max:100|unique:subspecialties,subspecialty_name,' . $this->route('id'),
        'specialty_id' => 'required|exists:specialties,id',
    ];

    }
    public function messages()
{
    return [
        'subspecialty_name.required' => 'اسم التخصص الفرعي مطلوب.',
        'subspecialty_name.unique'   => 'هذا التخصص الفرعي موجود مسبقًا.',
        'specialty_id.required'      => 'يجب اختيار التخصص الرئيسي.',
        'specialty_id.exists'        => 'التخصص المحدد غير صالح.',
    ];
}

}
