<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use Core\Exceptions\InvalidPasswordException;
use Core\Exceptions\LoginRequestUserNotFoundException;
use Core\Services\Login\LoginService;
use Core\ValueObjects\LoginObject;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginService $loginService
    )
    { }

    public function __invoke(LoginRequest $request)
    {
        $loginObject = new LoginObject($request->validated());

        try {
            $user = $this->loginService->loginUser($loginObject);

            return response()->json([
                'data' => [
                    'token' => $user->createToken($user->role_id->toString())->plainTextToken
                ]
            ]);
        } catch (LoginRequestUserNotFoundException|InvalidPasswordException $e) {
            throw ValidationException::withMessages([
                'email' => [
                    'Entered credentials is incorrect, please try again!'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something wrong happened, please call administrator'
            ], 500);
        }
    }
}
