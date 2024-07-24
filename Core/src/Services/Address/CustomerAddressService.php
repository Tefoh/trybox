<?php

namespace Core\Services\Address;

use Core\Repositories\CustomerAddressRepositoryInterface;
use Core\Repositories\UserRepositoryInterface;
use Core\ValueObjects\CustomerObject;

class CustomerAddressService
{
    public function __construct(
        private readonly CustomerAddressRepositoryInterface $customerRepository,
        private readonly UserRepositoryInterface            $userRepository,
    )
    { }

    public function save(CustomerObject $customerAddressObject, $user)
    {
        $userRole = $this->userRepository->getUserRole($user);

        $data = $customerAddressObject->handle(
            $userRole->toString(), $this->userRepository->getUserId($user)
        );

        return $this->customerRepository->store($data);
    }
}