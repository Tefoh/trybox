<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Store;
use Core\Repositories\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function addProductToStore(array $data, int $storeId)
    {
        $product = Product::query()
            ->create($data);

        $store = Store::query()
            ->find($storeId);

        $store->products()->sync([$product->id]);

        return $product->load('stores');
    }
}
