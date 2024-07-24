<?php

namespace Core\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): User|null;
}