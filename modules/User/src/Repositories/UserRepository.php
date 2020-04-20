<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Permission\Model\Permission;
use Modules\User\Contracts\Repositories\UserRepositoryInterface;
use Modules\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /** @var User */
    protected $model;

    /** @param User $model */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return User|Model
     */
    public function store(array $attributes): User
    {
        return $this->model->newQuery()->create($attributes);
    }

    /**
     * @param string $email
     * @return User|Model
     */
    public function findByEmail(string $email): User
    {
        return $this->model->newQuery()->where('email', $email)->firstOrFail();
    }

    /**
     * @param User $user
     * @return array
     */
    public function permissions(User $user): array
    {
        $permissionList = [];

        $user = $user->load('roles.permissions');

        foreach ($user->roles as $role) {
            $permissionList = $this->permissionsOfUserRoles($role, $permissionList);
        }

        return $permissionList;
    }

    /**
     * @param $role
     * @param $permissionList
     * @return array
     */
    protected function permissionsOfUserRoles($role, $permissionList): array
    {
        /** @var Permission $permission */
        foreach ($role->permissions as $permission) {
            $permissionList[] = $permission->key;
        }
        return $permissionList;
    }
}
