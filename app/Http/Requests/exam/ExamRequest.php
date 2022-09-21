<?php

namespace App\Http\Requests\exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'questions'=>'required|array',
            'questions.*.*'=>'required|exists:standards,id',
        ];
    }

    public function messages()
    {
        return [
            'questions.required'=>'الرجاء التأكد من إجابة الأسئلة',
            'questions.array'=>'الرجاء التأكد من إجابة الأسئلة',
            'questions.*.*.required'=>'الرجاء التأكد من إجابة الأسئلة',
            'questions.*.*.exists'=>'الرجاء التأكد من وضع قيم صحيحة'
        ];
    }
}
