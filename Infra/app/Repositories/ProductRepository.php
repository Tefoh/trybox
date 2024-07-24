<?php

namespace App\Repositories;

use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\Store;
use Core\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function getListOfCustomerProducts(int $userId)
    {
        $customerAddress = CustomerAddress::query()
            ->where('user_id', $userId)
            ->first();
        if (! $customerAddress) {
            throw new NotFoundHttpException();
        }

        $nearbyStores = Store::query()
            ->select(
                DB::raw(
                    'SELECT id,
                ( 6371 * acos( cos( radians(:c_lat) )
                    * cos( radians( lat ) )
                    * cos( radians( long ) - radians(:c_lon) )
                    + sin( radians(:c_lat) )
                    * sin( radians( lat ) ) ) ) AS distance
                FROM locations
                HAVING distance < :distance
                ORDER BY distance;'
                ),
            [
                'c_lat' => $customerAddress->lat,
                'c_lon' => $customerAddress->long,
                'distance' => 10,
            ])
            ->get()
            ->pluck('id');

        return Product::query()
            ->where(
                'store', fn (Builder $q) => $q->whereIn('id', $nearbyStores)
            )
            ->paginate();
    }

    public function getListOfSellerProducts(int $userId)
    {
        return Product::query()
            ->whereHas(
                'store', fn (Builder $q) => $q->where('user_id', $userId)
            )
            ->paginate();
    }

    public function getListOfProducts()
    {
        return Product::query()
            ->paginate();
    }
}
