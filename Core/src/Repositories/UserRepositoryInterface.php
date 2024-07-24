<?php

namespace Core\Repositories;

use App\Models\User;
use Core\Enums\RoleEnum;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): User|null;

    public function createToken($user): string;

    public function getUserRole($user): RoleEnum;

    public function getUserId($user): int;
}