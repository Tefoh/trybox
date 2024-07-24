<?php

namespace Core\Exceptions;

class InvalidArgument extends \Exception
{
    public function __construct(
        private readonly string $field,
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}