<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGovernorateRequest extends FormRequest
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
            'governorate_name' => 'required|string|max:50|unique:governorates,governorate_name',
        ];

    }
    public function messages()
    {
        return [
            'governorate_name.required' => 'اسم المحافظة مطلوب.',
            'governorate_name.string'   => 'يجب أن يكون اسم المحافظة نصًا.',
            'governorate_name.max'      => 'اسم المحافظة يجب ألا يزيد عن 50 حرف.',
            'governorate_name.unique'   => 'اسم المحافظة مُسجل مسبقًا.',
        ];
    }

}
