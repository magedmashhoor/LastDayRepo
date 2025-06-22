<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        'username'       => 'required|string|max:50|unique:users,username,' . $this->route('id'),
        'first_name'     => 'required|string|max:50',
        'last_name'      => 'required|string|max:50',
        'email'          => 'required|email|unique:users,email,' . $this->route('id'),
        'password_hash'  => 'required|string|min:6',
        'phone_number'   => 'nullable|string|max:20',
        'user_type'      => 'required|in:admin,doctor,patient', // or your defined types
        'governorate_id' => 'required|exists:governorates,id',
        'district_id'    => 'required|exists:districts,id',
    ];
}
}
