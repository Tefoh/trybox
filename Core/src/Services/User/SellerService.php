<?php

namespace Core\Services\User;

use Core\Repositories\UserRepositoryInterface;
use Core\ValueObjects\SellerObject;

class SellerService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    )
    { }

    public function save(SellerObject $sellerObject, $user)
    {
        $userRole = $this->userRepository->getUserRole($user);

        $data = $sellerObject->handle($userRole->toString());

        return $this->userRepository->store($data);
    }
}