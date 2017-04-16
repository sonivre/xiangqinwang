<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/8
 * Time: 15:42
 */

namespace App\Konohanaruto\Validators;
use Illuminate\Support\Facades\Validator;

abstract class CustomRuleValidator extends Validator
{
    protected $rules;
    protected $errorMessages;

    abstract public function runValidatorChecks($input);
}