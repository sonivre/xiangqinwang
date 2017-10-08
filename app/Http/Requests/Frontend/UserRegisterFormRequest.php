<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use MemberRegisterService;

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
            'username' => 'required|register_username|unique:user,username,null,user_id',
            'email' => 'email',
            'password' => 'required',
            'gender' => 'in:1,2',
            'birthyear' => 'numeric',
            'birthmonth' => 'numeric',
            'birthday' => 'numeric',
            'height' => 'numeric',
            'education' => 'numeric',
            'resideprovince' => 'numeric',
            'residecity' => 'numeric',
            'revenue' => 'numeric',
            'mobile' => 'numeric|is_mobile',
            'mobile_verify_code' => 'numeric|six_number',
            'license' => 'in:1'
        ];
    }

    /**
     * 重写父类方法
     */
    public function messages()
    {
        return [
//            'username.required' => '用户名不能为空',
//            'username.unique' => '用户名已经被注册',
//            'username.register_username' => '用户名格式不正确',
//            'gender.in' => '性别格式不正确',
//            'numeric' => ':attribute必须是一个数字',
//            'mobile.is_mobile' => '手机号格式不正确',
//            'mobile_verify_code' => '手机验证码格式不正确',
//            'license.in' => '必须同意注册许可'
        ];
    }

    /**
     * 验证后的钩子
     *
     * @param $validator Illuminate\Validation\Validator
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // 拿到所有input的数据
            $validateData = $validator->getData();
            // 得到短信验证码
            $code = MemberRegisterService::getLatestValidMobileCode($validateData['mobile']);

            if ($validateData['mobile_verify_code'] != $code) {
                $validator->errors()->add('mobile_verify_code', trans('register_service.register_mobile_verify_code_missed'));
            }
        });
    }
}
