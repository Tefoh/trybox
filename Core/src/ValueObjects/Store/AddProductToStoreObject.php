<?php

namespace Core\ValueObjects\Store;

use Core\Enums\RoleEnum;
use Core\Exceptions\ForbiddenException;
use Core\Exceptions\InvalidArgument;

class AddProductToStoreObject
{
    public function __construct(
        private readonly array $properties,
    )
    { }

    public function handle(string $userRole, $storeId)
    {
        return match ($userRole) {
            RoleEnum::CUSTOMER->toString() => $this->getCustomerData(),
            RoleEnum::SELLER->toString() => $this->getSellerData($userRole, $storeId),
            RoleEnum::ADMIN->toString() => $this->getAdminData(),
        };
    }

    private function getCustomerData(): array
    {
        throw new ForbiddenException();
    }

    private function getSellerData($userId)
    {
        $data = $this->properties;
        $data['user_id'] = $userId;

        return $data;
    }

    private function getAdminData(): array
    {
        if (! isset($this->properties['user_id'])) {
            throw new InvalidArgument('user_id', 'This field is necessary');
        }
        $data = $this->properties;
        $data['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'])));

        return $data;
    }
}