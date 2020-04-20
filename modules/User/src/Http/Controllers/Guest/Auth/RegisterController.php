<?php

namespace Modules\User\Http\Controllers\Guest\Auth;

use App\Http\Controllers\Controller;
use Modules\User\Events\UserHasRegistered;
use Modules\User\Resources\UserResource;
use Modules\User\Contracts\Repositories\UserRepositoryInterface;
use Modules\User\Http\Requests\UserRequest;

class RegisterController extends Controller
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
     * @param UserRequest $request
     * @return UserResource
     */
    public function __invoke(UserRequest $request): UserResource
    {
        $request['password'] = bcrypt($request->get('password'));

        $user = $this->userRepository->store($request->all());

        event(new UserHasRegistered($user));

        return new UserResource($user);
    }
}
