<?php

namespace Core\Services\Product;

use Core\Enums\RoleEnum;
use Core\Exceptions\ForbiddenException;
use Core\Repositories\OrderRepositoryInterface;
use Core\Repositories\ProductRepositoryInterface;
use Core\Repositories\StoreRepositoryInterface;
use Core\Repositories\TransactionRepositoryInterface;
use Core\Repositories\UserRepositoryInterface;
use Core\ValueObjects\Products\BuyProductObject;
use Core\ValueObjects\Store\AddProductToStoreObject;
use Illuminate\Support\Facades\Http;

class ProductService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly StoreRepositoryInterface $storeRepository,
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly TransactionRepositoryInterface $transactionRepository,
    )
    { }

    public function getProducts($user)
    {
        $userRole = $this->userRepository->getUserRole($user);
        $userId = $this->userRepository->getUserId($user);

        return match ($userRole) {
            RoleEnum::CUSTOMER => $this->productRepository->getListOfCustomerProducts($userId),
            RoleEnum::SELLER => $this->productRepository->getListOfSellerProducts($userId),
            RoleEnum::ADMIN => $this->productRepository->getListOfProducts(),
        };
    }

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

    public function buyProduct(BuyProductObject $buyProductObject, $user, int $productId)
    {
        $userId = $this->userRepository->getUserId($user);

        $data = $buyProductObject->getData();

        $order = $this->orderRepository->create($data, $userId);

        return $this->transactionRepository->create($order);
    }

    public function updateTheTransactionNumber($transaction, $transactionNumber)
    {
        return $this->transactionRepository->updateTransactionNumber(
            $transaction, $transactionNumber
        );
    }

    public function checkTransactionNumberExists($transactionNum): bool
    {
        return $this->transactionRepository->transactionNumberExists($transactionNum);
    }

    public function processTransactionAndOrder($transactionNum, $hasPaid)
    {
        $transaction = $this->transactionRepository->markTransactionAsDone($transactionNum);

        return $this->orderRepository->processOrder($transaction['order_id'], $hasPaid);
    }
}