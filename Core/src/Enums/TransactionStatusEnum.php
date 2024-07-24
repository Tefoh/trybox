<?php

namespace Core\Enums;

enum TransactionStatusEnum: int
{
    case IN_PROGRESS = 1;
    case DONE = 2;

    public function toString(): string
    {
        return match ($this) {
            self::IN_PROGRESS => 'in progress',
            self::DONE => 'done',
        };
    }
}
