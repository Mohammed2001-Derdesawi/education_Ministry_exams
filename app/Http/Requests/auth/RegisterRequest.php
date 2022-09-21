<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email|string|unique:admins,email|max:255|min:7',
            'password'=>'required|confirmed|string|max:25|min:7',
            'specialization'=>'required|exists:specializations,id|integer',
            'office'=>'nullable|integer|exists:offices,id',
            'type'=>'required|string',
        ];
    }


        public function messages()
        {
            return [
                'type.string'=>'الرجاء اختيار نوع الحساب',
                'type.required'=>'الرجاء اختيار نوع الحساب',
                'email.required'=>'البريد الإلكتروني مطلوب',
                'specialization.required'=>'الرجاء اختيار تخصص',
                'password.required'=>'كلمة المرور  مطلوبة',
                'password.min'=>'كلمة المرور  يجب أن تكون ما بين 7 أحرف و 25 حرف',
                'password.max'=>'كلمة المرور  يجب أن تكون ما بين 7 أحرف و 25 حرف',
                'password.string'=>'كلمة المرور  يجب أن تكون نصا ',
                'email.email'=>'الرجاء التأكد من إدخال بريدا صحيحا',
                'email.unique'=>'البريد الإلكتورني موجود',
                'email.string'=>'البريد يجب أن يكون نصا',
                'email.min'=>' 7 حرف , 255 حرفا الرجاء إدخال بريد عدد الأحرف يكون ما بين ',
                'email.max'=>' 7 حرف , 255 حرفا الرجاء إدخال بريد عدد الأحرف يكون ما بين ',
                'password.confirmed'=>'تأكيد كلمة المرور غير متطابقة',
                'specialization.integer'=>' الرجاء اختيار تخصص صحيح',
                'specialization.exists'=>' الرجاء اختيار تخصص صحيح',
                'office.exists'=>' الرجاء اختيار مكتب تعليم صحيح',
                'office.integer'=>' الرجاء اختيار مكتب تعليم صحيح',


            ];

        }

}
