<?php

namespace Modules\Authorization\Role\Contracts\Repositories;

use App\Contracts\Repositories\CrudRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Role\Model\Role;

interface RoleRepositoryInterface extends CrudRepositoryInterface
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
     * @return Role
     */
    public function findRoleByName(string $roleName): Role;
}
