<?php

namespace Modules\Authorization\Role\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Role\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Authorization\Role\Model\Role;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * @var Role
     */
    protected $model;

    /**
     * UserEloquentRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @param Role $role
     * @param array $permissionIds
     * @return mixed|void
     */
    public function syncPermissions(Role $role, array $permissionIds)
    {
        $role->permissions()->sync($permissionIds);
    }

    /**
     * @param string $roleName
     * @return Role|Model
     */
    public function findRoleByName(string $roleName): Role {
        return $this->model->newQuery()->where('name', $roleName)->firstOrFail();
    }
}
