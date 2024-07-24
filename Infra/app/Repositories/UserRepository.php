<?php

namespace App\Repositories;

use App\Models\User;
use Core\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): User|null
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    public function createToken($user): string
    {
        return $user->createToken($user->role_id->toString())->plainTextToken;
    }
}
