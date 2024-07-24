<?php

namespace Core\Repositories;

interface ProductRepositoryInterface
{
    public function addProductToStore(array $data, int $storeId);
}