<?php

namespace App\Repositories;

use App\Models\Order;
use Core\Enums\OrderStatusEnum;
use Core\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

    public function create(array $data, $userId)
    {
        $productOrder = Order::query()->find($data['product_id']);
        if ($productOrder) {
            return $productOrder->toArray();
        }

        $data['uuid'] = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16))));
        $data['status'] = OrderStatusEnum::OPEN;
        $data['user_id'] = $userId;

        return Order::query()
            ->create($data)
            ->toArray();
    }
}
