<?php

namespace Core\ValueObjects;

class LoginObject
{
    public function __construct(
        private readonly array $properties
    )
    { }

    public function credentials(): array
    {
        return [
            'email' => $this->properties['email'],
            'password' => $this->properties['password'],
        ];
    }
}