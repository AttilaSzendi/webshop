<?php

namespace Modules\User\Http\Controllers\Guest\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Contracts\Repositories\UserRepositoryInterface;

class LoginController
{
    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param Guard $guard
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(Guard $guard, UserRepositoryInterface $userRepository)
    {
        $this->guard = $guard;
        $this->userRepository = $userRepository;
    }


    public function __invoke(Request $request)
    {
        if (! $token = $this->guard->attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'invalid.credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->userRepository->findByEmail($request->get('email'));

        if(!$user->hasVerifiedEmail()){
            return response()->json(['error' => 'email.not.verified'], Response::HTTP_FORBIDDEN);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard->factory()->getTTL() * 60
        ]);
    }
}
