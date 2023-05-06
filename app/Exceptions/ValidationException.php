<?php

namespace App\Exceptions;
use Exception;

class ValidationException extends Exception
{
    public $errors;

    public function __construct($message, $code, $errors)
    {
        parent::__construct($message, $code);
        $this->errors = $errors;
    }
}
