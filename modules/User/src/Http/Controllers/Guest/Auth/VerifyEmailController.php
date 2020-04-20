<?php

namespace Modules\User\Http\Controllers\Guest\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Models\User;
use Modules\User\Resources\UserResource;

class VerifyEmailController extends Controller
{
    const ALREADY_VERIFIED_EMAIL = 'already.verified.email';

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse|UserResource
     * @throws AuthorizationException
     */
    public function __invoke(Request $request, User $user)
    {
        if (!hash_equals((string)$request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if ($user->hasVerifiedEmail()) {
            return new JsonResponse(['message' => static::ALREADY_VERIFIED_EMAIL], Response::HTTP_BAD_REQUEST);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return new UserResource($user);
    }
}
