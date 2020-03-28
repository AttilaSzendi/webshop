<?php

namespace Modules\Authorization\Role\Services;

use App\User;
use Modules\Authorization\Role\Contracts\Services\UserRoleHandlerInterface;
use Modules\Authorization\Role\Model\Role;
use Modules\User\Contracts\Repositories\UserRepositoryInterface;

class UserRoleHandler implements UserRoleHandlerInterface {

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $roleIds
     * @param User  $user
     */
    public function setRoles(array $roleIds, User $user): void {
        $this->userRepository->syncRoles($user, array_unique($roleIds));
    }

    /**
     * @inheritDoc
     */
    public function addRoleToUser(Role $role, User $user): void {
       $roles = $user->roles;

       // Ha már megvan a role
       if ($roles->contains($role)) {
           return;
       }

       $roleIds = $roles->pluck('id')->toArray();
       $roleIds[] = $role->id;
       $roleIds = array_unique($roleIds);

       $this->userRepository->syncRoles($user, $roleIds);
    }

    /**
     * @inheritDoc
     */
    public function removeRoleFromUser(Role $role, User $user): void {
        $roles = $user->roles;

        // Ha már nincs meg a role
        if (!$roles->contains($role)) {
            return;
        }

        $roleIds = $roles->pluck('id')->toArray();
        $roleIds = array_diff($roleIds, [$role->id]);
        $roleIds = array_unique($roleIds);

        $this->userRepository->syncRoles($user, $roleIds);
    }
}