<?php

namespace Modules\Authorization\Role\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Role\Model\Role;

interface RoleRepositoryInterface
{
    /**
     * @param Role|Model $role
     * @param array $permissionIds
     * @return mixed
     */
    public function syncPermissions(Role $role, array $permissionIds);

    /**
     * @param string $roleName
     *
     * @return Role|Model
     */
    public function findRoleByName(string $roleName): Role;
}
