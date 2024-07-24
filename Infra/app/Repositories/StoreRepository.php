<?php

namespace App\Repositories;

use App\Models\Store;
use Core\Repositories\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{
    public function checkIfBelongsToSeller(int $storeId, int $userId): bool
    {
        return Store::query()
            ->where('id', $storeId)
            ->where('user_id', $userId)
            ->exists();
    }
}
