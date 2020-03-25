<?php

namespace Modules\User\Http\Controllers\Free\Auth;

use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends AccessTokenController
{
    public function __invoke(ServerRequestInterface $request)
    {
        return $this->issueToken($request);
    }
}
