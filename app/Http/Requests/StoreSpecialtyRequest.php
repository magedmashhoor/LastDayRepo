<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialtyRequest extends FormRequest
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
            'specialty_name' => 'required|string|max:100|unique:specialties,specialty_name,' . $this->route('id'),
        ];
    }
    public function messages()
{
    return [
        'specialty_name.required' => 'اسم التخصص مطلوب.',
        'specialty_name.string'   => 'اسم التخصص يجب أن يكون نصًا.',
        'specialty_name.max'      => 'اسم التخصص لا يجب أن يتجاوز 100 حرف.',
        'specialty_name.unique'   => 'اسم التخصص مسجل مسبقًا.',
    ];
}

}
