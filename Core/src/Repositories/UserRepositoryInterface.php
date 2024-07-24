<?php

namespace Core\Repositories;

use Core\Enums\RoleEnum;

interface UserRepositoryInterface
{
    public function findByEmail(string $email);

    public function createToken($user): string;

    public function getUserRole($user): RoleEnum;

    public function getUserId($user): int;

    public function store(array $data);
}