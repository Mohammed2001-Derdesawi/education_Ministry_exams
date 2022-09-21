<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'name'=>'required|max:35|min:3|string',
            'specialization'=>'required|exists:specializations,id|integer',
            'office'=>'required|exists:offices,id|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'الإسم مطلوب',
            'name.max'=>'أقصى عدد حروف للإسم 35',
            'name.min'=>'أفل عدد حروف للإسم 3',
             'specialization.required'=> 'الرجاء اختيار مسار',
             'office.required'=> 'الرجاء اختيار مكتب تعليم',
             'office.exists'=>'عذرا مكتب التعليم ليس موجود',
             'specialization.exists'=>'عذرا المسار ليس موجود'

        ];
    }
}
