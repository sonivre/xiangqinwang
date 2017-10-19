<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => ':attribute' . trans('validation.required'),
            'password.required' => ':attribute' . trans('validation.required'),
        ];
    }

    /**
     * override 属性别名 "nice name"
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'username' => trans('label_fields.username'),
            'password' => trans('label_fields.password'),
        ];
    }
}
