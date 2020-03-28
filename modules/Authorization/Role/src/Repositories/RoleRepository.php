<?php

namespace Modules\Authorization\Role\Repositories;

use App\Repositories\AbstractEloquentCrudRepository;
use Modules\Authorization\Role\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Authorization\Role\Model\Role;

class RoleRepository extends AbstractEloquentCrudRepository implements RoleRepositoryInterface
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
     * @inheritDoc
     */
    public function findRoleByName(string $roleName): Role {
        return $this->model->newQuery()->where('name', $roleName)->firstOrFail();
    }
}
