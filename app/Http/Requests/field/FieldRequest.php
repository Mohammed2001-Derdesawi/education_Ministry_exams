<?php

namespace App\Http\Requests\field;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
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
            'name'=>'required|max:255|string|min:4'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'الرجاء إدخال اسم المجال',
            'name.string'=>'يجب ان يكون المجال نص',
            'name.max'=>'الرجاء إدخال اسم مجال يكون ما بين 4 إلى 255 حرف',
            'name.min'=>'الرجاء إدخال اسم مجال يكون ما بين 4 إلى 255 حرف',
        ];
    }
}
