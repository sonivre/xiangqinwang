<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/8
 * Time: 16:00
 */
namespace  App\Konohanaruto\Validators;

class EmailPasswordValidator extends CustomRuleValidator
{
    protected $rules = array(
        'username' => 'bail|required|email',
        'password' => 'bail|required|digits_between:6,16'
    );

    protected $errorMessages = array(
        'username.required' => '用户名不能为空',
        'username.email' => '非有效的邮箱格式',
        'password.required' => '密码不能为空',
        'password.digits_between' => '密码必须在6-16个字符之间'
    );

    /**
     * 验证
     * @param array @rules
     * @param array @errorMessages
     * @return mixed
     */
    public function runValidatorChecks($input)
    {
        // TODO: Implement runValidatorChecks() method.
        if (! is_array($input) || ! key_exists('username', $input) || ! key_exists('password', $input)) {
            return false;
        }
        return static::make($input, $this->rules, $this->errorMessages);
    }
}