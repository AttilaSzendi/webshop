<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Modules\User\Contracts\Repositories\UserRepositoryInterface;

class Authorize
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param  Request $request
     * @param  Closure $next
     * @param  string $permission
     * @return mixed
     */
    public function handle($request, Closure $next, string $permission)
    {
        $this->checkPermission($request->user(), $permission);

        return $next($request);
    }

    /**
     * @param User $user
     * @param string $permission
     */
    protected function checkPermission(User $user, string $permission): void
    {
        $userPermissions = $this->userRepository->permissions($user);

        if (!in_array($permission, $userPermissions)) {
            throw new HttpException(Response::HTTP_FORBIDDEN, __('authorize.unauthorized'));
        }
    }
}
