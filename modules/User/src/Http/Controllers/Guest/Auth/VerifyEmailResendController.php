<?php

namespace Modules\User\Http\Controllers\Guest\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyEmailResendController extends Controller
{
    /**
     * Resend the email verification notification.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return new Response(['message' => 'already.verified.email'], Response::HTTP_BAD_REQUEST);
        }

        $request->user()->sendEmailVerificationNotification();

        return new Response('', 202);
    }
}
