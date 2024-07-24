<?php

namespace Core\Enums;

enum OrderStatusEnum: int
{
    case OPEN = 1;
    case FAILED = 2;
    case PAID = 3;

    public function toString(): string
    {
        return match ($this) {
            self::OPEN => 'open',
            self::FAILED => 'failed',
            self::PAID => 'paid',
        };
    }
}
