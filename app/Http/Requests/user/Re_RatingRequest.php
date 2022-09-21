<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class Re_RatingRequest extends FormRequest
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
           'questions'=>'required|array',
           'questions.*'=>'required|exists:standards,mark',
       ];
   }

   public function messages()
   {
       return [
           'questions.required'=>'الرجاء التأكد من إجابة الأسئلة',
           'questions.array'=>'الرجاء التأكد من إجابة الأسئلة',
           'questions.*.required'=>'الرجاء التأكد من إجابة الأسئلة',
           'questions.*.exists'=>'الرجاء التأكد من وضع قيم صحيحة'
       ];
   }
}
