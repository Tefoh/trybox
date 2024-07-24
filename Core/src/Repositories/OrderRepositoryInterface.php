<?php

namespace Core\Repositories;

use Core\Enums\RoleEnum;

interface OrderRepositoryInterface
{
    public function create(array $data, $userId);
}