<?php

namespace App\Http\Requests\norm;

use Illuminate\Foundation\Http\FormRequest;

class NormRequest extends FormRequest
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
            'norm'=>'required|string|min:4',
            'field'=>'required|integer|exists:fields,id',
            'standards'=>'required|array',
            'standards.*.*'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'norm.required'=>'المعيار المطلوب',
            'norm.string'=>'الرجاء التأكد من إدخال قيمة صحيحة للمعيار',
            'norm.min'=>'القيمة الادنى للمعيار 4 حروف ',
            'field.required'=>'الرجاء اختيار مجال',
            'field.integer'=>'الرجاء ادخال قيمة صحيحة للمجال',
            'field.exists'=>'الرجاء ادخال قيمة صحيحة للمجال',
            'standards.required'=>'الرجاء إدخال المقاييس',
            'standards.array'=>'الرجاء إدخال قيم صحيحة للمقاييس',
             'standards.first.standard.required'=>'حقل المؤشر الاول مطلوب',
             'standards.first.mark.required'=>'حقل  علامة المؤشر الاول مطلوب',
             'standards.seconed.standard.required'=>'حقل المؤشر الثاني مطلوب',
             'standards.seconed.mark.required'=>'حقل علامة المؤشر الثاني مطلوب',
             'standards.third.standard.required'=>'حقل المؤشر الثالث مطلوب',
             'standards.third.mark.required'=>'حقل علامة المؤشر الثالث مطلوب',


        ];
    }
}
