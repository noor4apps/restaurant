<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CannotAddNodeException extends Exception
{
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;

    public static function because(string $reason)
    {
        return new CannotAddNodeException($reason);
    }
}
