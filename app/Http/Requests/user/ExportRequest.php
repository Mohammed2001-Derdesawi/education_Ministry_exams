<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
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
            'from'=>'date|before:to|required',
            'to'=>'date|after:from|required',
        ];
    }

    public function messages()
    {
        return [
            'from.required'=>'الرجاء ادخال تاريخ بداية الطباعة',
            'to.required'=>'الرجاء ادخال تاريخ نهاية الطباعة',
            'to.date'=>'الرجاء التأكد من إدخال قيم صحيحة',
            'from.date'=>'الرجاء التأكد من إدخال قيم صحيحة',
            'to.after'=>'يجب أن يكون تاريخ نهاية الطباعة بعد تاريخ بداية الطباعة',
            'from.before'=>'يجب أن يكون تاريخ بداية الطباعة قبل تاريخ نهاية الطباعة',
        ];
    }
}
