<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterFormRequest extends FormRequest
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
            'username' => 'required|register_username',
            'gender' => 'in:1,2',
            'birthyear' => 'numeric',
            'birthmonth' => 'numeric',
            'birthday' => 'numeric',
            'height' => 'numeric',
            'education' => 'numeric',
            'resideprovince' => 'numeric',
            'residecity' => 'numeric',
            'revenue' => 'numeric',
            'mobile' => 'numeric',
            'mobile_verify_code' => 'numeric',
            'license' => 'in:1'
        ];
    }
}
