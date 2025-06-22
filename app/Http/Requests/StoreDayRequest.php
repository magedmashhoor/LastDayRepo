<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDayRequest extends FormRequest
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
            'day_name' => 'required|string|unique:days,day_name|max:20',
        ];
    }
    public function messages()
    {
        return [
            'day_name.required' => 'اسم اليوم مطلوب.',
            'day_name.string'   => 'يجب أن يكون اسم اليوم نصًا.',
            'day_name.max'      => 'اسم اليوم لا يجب أن يتجاوز 20 حرفًا.',
            'day_name.unique'   => 'هذا اليوم مسجل مسبقًا.',
        ];
    }
}
