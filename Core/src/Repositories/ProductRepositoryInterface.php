<?php

namespace Core\Repositories;

interface ProductRepositoryInterface
{
    public function addProductToStore(array $data, int $storeId);

    public function getListOfCustomerProducts(int $userId);

    public function getListOfSellerProducts(int $userId);

    public function getListOfProducts();
}