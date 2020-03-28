<?php

namespace Modules\Authorization\Role\Contracts\Services;

use App\User;
use Modules\Authorization\Role\Model\Role;

interface UserRoleHandlerInterface {

    public function setRoles(array $roleIds, User $user): void;

    /**
     * @param Role $role
     * @param User $user
     */
    public function addRoleToUser(Role $role, User $user): void;

    /**
     * @param Role $role
     * @param User $user
     */
    public function removeRoleFromUser(Role $role, User $user): void;
}