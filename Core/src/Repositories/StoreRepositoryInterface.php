<?php

namespace Core\Repositories;

interface StoreRepositoryInterface
{
    public function checkIfBelongsToSeller(int $storeId, int $userId): bool;
}