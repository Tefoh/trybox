<?php

namespace App\Repositories;

use App\Models\User;
use Core\Enums\RoleEnum;
use Core\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email)
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    public function createToken($user): string
    {
        return $user->createToken($user->role_id->toString())->plainTextToken;
    }

    public function getUserRole($user): RoleEnum
    {
        return $user->role_id;
    }

    public function getUserId($user): int
    {
        return $user->id;
    }

    public function store(array $data)
    {
        return User::query()
            ->create($data);
    }
}
