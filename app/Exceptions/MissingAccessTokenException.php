<?php

namespace App\Exceptions;

use Exception;

class MissingAccessTokenException extends Exception
{
    protected $message = 'Missing Google Access Token.';
}
