<?php

namespace Core\Enums;

enum RoleEnum: int
{
    case CUSTOMER = 1;
    case SELLER = 2;
    case ADMIN = 3;

    public function toString(): string
    {
        return match ($this) {
            self::CUSTOMER => 'customer',
            self::SELLER => 'seller',
            self::ADMIN => 'admin',
        };
    }
}
