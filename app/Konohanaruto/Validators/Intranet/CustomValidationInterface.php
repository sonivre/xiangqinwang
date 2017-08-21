<?php

namespace App\Konohanaruto\Validators\Intranet;

interface CustomValidationInterface
{
    public function name();
    
    public function runCheck();
    
    public function errorMessage();
}