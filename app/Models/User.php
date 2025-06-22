<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     use HasFactory;

    protected $fillable = [
        'username', 'first_name', 'last_name', 'email',
        'password_hash', 'phone_number', 'user_type',
        'governorate_id', 'district_id',
    ];
    public function messages()
{
    return [
        'username.required' => 'يرجى إدخال اسم المستخدم.',
        'username.string'   => 'اسم المستخدم يجب أن يكون نصًا.',
        'username.max'      => 'اسم المستخدم لا يزيد عن 50 حرفًا.',
        'username.unique'   => 'اسم المستخدم مسجل مسبقًا.',

        'first_name.required' => 'يرجى إدخال الاسم الأول.',
        'first_name.string'   => 'الاسم الأول يجب أن يكون نصًا.',
        'first_name.max'      => 'الاسم الأول لا يزيد عن 50 حرفًا.',

        'last_name.required' => 'يرجى إدخال الاسم الأخير.',
        'last_name.string'   => 'الاسم الأخير يجب أن يكون نصًا.',
        'last_name.max'      => 'الاسم الأخير لا يزيد عن 50 حرفًا.',

        'email.required' => 'يرجى إدخال البريد الإلكتروني.',
        'email.email'    => 'صيغة البريد الإلكتروني غير صحيحة.',
        'email.unique'   => 'البريد الإلكتروني مستخدم مسبقًا.',

        'password_hash.required' => 'كلمة المرور مطلوبة.',
        'password_hash.string'   => 'كلمة المرور يجب أن تكون نصية.',
        'password_hash.min'      => 'كلمة المرور يجب أن تتكون من 6 أحرف على الأقل.',

        'phone_number.string' => 'رقم الهاتف يجب أن يكون نصًا.',
        'phone_number.max'    => 'رقم الهاتف لا يزيد عن 20 رقمًا.',

        'user_type.required' => 'يرجى اختيار نوع المستخدم.',
        'user_type.in'       => 'نوع المستخدم غير صالح.',

        'governorate_id.required' => 'يرجى اختيار المحافظة.',
        'governorate_id.exists'   => 'المحافظة المحددة غير موجودة.',

        'district_id.required' => 'يرجى اختيار المديرية.',
        'district_id.exists'   => 'المديرية المحددة غير موجودة.',
    ];
}
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }




}
