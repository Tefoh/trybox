<?php

namespace Core\ValueObjects;


use Core\Enums\RoleEnum;
use Core\Exceptions\ForbiddenException;
use Core\Exceptions\InvalidArgument;

class CustomerObject
{
    public function __construct(
        private readonly array $properties,
    )
    { }

    public function handle(string $userRole, int $userId)
    {
        return match ($userRole) {
            RoleEnum::CUSTOMER->toString() => $this->getCustomerData($userId),
            RoleEnum::SELLER->toString() => $this->getSellerData(),
            RoleEnum::ADMIN->toString() => $this->getAdminData(),
        };
    }

    private function getCustomerData($userId): array
    {
        $data = $this->properties;
        $data['user_id'] = $userId;
        return $data;
    }

    private function getSellerData()
    {
        throw new ForbiddenException();
    }

    private function getAdminData(): array
    {
        if (! isset($this->properties['user_id'])) {
            throw new InvalidArgument('user_id', 'This field is necessary');
        }
        return $this->properties;
    }
}