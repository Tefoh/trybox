<?php

namespace Core\Services\Product;

use Core\Enums\RoleEnum;
use Core\Exceptions\ForbiddenException;
use Core\Repositories\ProductRepositoryInterface;
use Core\Repositories\StoreRepositoryInterface;
use Core\Repositories\UserRepositoryInterface;
use Core\ValueObjects\Store\AddProductToStoreObject;

class ProductService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly StoreRepositoryInterface $storeRepository,
    )
    { }

    public function save(AddProductToStoreObject $addProductToStoreObject, $user, int $storeId)
    {
        $userRole = $this->userRepository->getUserRole($user);
        $userId = $this->userRepository->getUserId($user);

        if (
            $userRole === RoleEnum::SELLER
            && ! $this->storeRepository->checkIfBelongsToSeller($storeId, $userId)
        ) {
            throw new ForbiddenException();
        }

        $data = $addProductToStoreObject->handle($userRole->toString(), $storeId);

        return $this->productRepository->addProductToStore($data, $storeId);
    }
}