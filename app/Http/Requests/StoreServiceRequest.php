<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
        'service_name' => 'required|string|max:100|unique:services,service_name,' . $this->route('id'),
        'service_description' => 'nullable|string',
    ];

    }
    public function messages()
{
    return [
        'service_name.required' => 'اسم الخدمة مطلوب.',
        'service_name.string'   => 'اسم الخدمة يجب أن يكون نصًا.',
        'service_name.max'      => 'اسم الخدمة لا يتجاوز 100 حرف.',
        'service_name.unique'   => 'اسم الخدمة مسجل مسبقًا.',
        'service_description.string' => 'وصف الخدمة يجب أن يكون نصًا.',
    ];
}

}
