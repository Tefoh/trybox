<?php

namespace App\Repositories;

use App\Models\CustomerAddress;
use Core\Repositories\CustomerAddressRepositoryInterface;

class CustomerAddressRepository implements CustomerAddressRepositoryInterface
{
    public function store(array $data): CustomerAddress
    {
        return CustomerAddress::query()
            ->create($data);
    }
}
