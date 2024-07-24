<?php

namespace Core\Services\Login;

use Core\Exceptions\InvalidPasswordException;
use Core\Exceptions\LoginRequestUserNotFoundException;
use Core\Repositories\UserRepositoryInterface;
use Core\ValueObjects\LoginObject;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    )
    { }

    /**
     * @throws LoginRequestUserNotFoundException
     * @throws InvalidPasswordException
     */
    public function loginUser(LoginObject $loginObject)
    {
        $credentials = $loginObject->credentials();

        $user = $this->userRepository->findByEmail($credentials['email']);

        if (! $user) {
            throw new LoginRequestUserNotFoundException(
                'User with "' . $credentials['email'] .'" email has not been found.'
            );
        }

        if (! password_verify($credentials['password'], $user->password)) {
            throw new InvalidPasswordException(
                'User with "' . $credentials['email'] .'" email has entered incorrect password.'
            );
        }

        return $user;
    }

    public function createToken($user): string
    {
        return $this->userRepository->createToken($user);
    }
}