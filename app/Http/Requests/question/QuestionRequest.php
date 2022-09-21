<?php

namespace App\Http\Requests\question;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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

    public function rules()
    {
        return [
            'question'=>'required_without:photo|string',
             'photo'=>'nullable|mimes:png,jpg,gif,jpeg',
            'norm'=>'required|exists:norms,id|integer'
        ];
    }

    public function messages()
    {
        return [
            'question.required_without'=>'حقل السؤال مطلوب في حال  عدم وجود صورة',
             'norm.required'=>'الرجاء اختيار معيار ',
            'norm.exists'=>'الرجاء إختيار قيمة صحيحة للمعيار',
            'photo.mimes'=>'يجب أن يكون امتداد الصورة png,jpeg,gif,jpg'

        ];
    }
}
