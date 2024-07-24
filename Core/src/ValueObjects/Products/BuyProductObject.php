<?php

namespace Core\ValueObjects\Products;

class BuyProductObject
{
    public function __construct(
        private readonly array $properties
    )
    { }

    public function getData(): array
    {
        return $this->properties;
    }
}