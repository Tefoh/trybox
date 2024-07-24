<?php

namespace Core\ValueObjects;


use Core\Enums\RoleEnum;
use Core\Exceptions\ForbiddenException;
use Core\Exceptions\InvalidArgument;

class SellerObject
{
    public function __construct(
        private readonly array $properties,
    )
    { }

    public function handle(string $userRole)
    {
        return match ($userRole) {
            RoleEnum::CUSTOMER->toString() => $this->getCustomerData(),
            RoleEnum::SELLER->toString() => $this->getSellerData(),
            RoleEnum::ADMIN->toString() => $this->getAdminData(),
        };
    }

    private function getCustomerData(): array
    {
        throw new ForbiddenException();
    }

    private function getSellerData()
    {
        throw new ForbiddenException();
    }

    private function getAdminData(): array
    {
        $data = $this->properties;
        $data['password'] = 'password';
        $data['role_id'] = RoleEnum::SELLER;

        return $data;
    }
}