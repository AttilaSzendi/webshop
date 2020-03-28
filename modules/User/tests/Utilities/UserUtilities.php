<?php

namespace Modules\User\Tests\Utilities;

use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Permission\Model\Permission;
use Modules\Authorization\Role\Model\Role;
use Modules\User\Models\User;

class UserUtilities
{
    public function createUserWithRoleAndPermissions($role, $permissions, $parameters = []): User
    {
        $permissionIds = [];

        foreach ($permissions as $permission) {
            $permissionIds[] = $this->findOrCreatePermission($permission)->id;
        }

        $role = $this->findOrCreateRole($role);

        /** @var User $user */
        $user = factory(User::class)->create($parameters);
        $role->permissions()->sync($permissionIds);
        $user->roles()->sync([$role->id]);

        return $user;
    }

    /**
     * @param $permission
     * @return Permission|Model
     */
    protected function findOrCreatePermission($permission): Permission
    {
        return Permission::query()->firstOrCreate(['key' => $permission]);
    }

    /**
     * @param $role
     * @return Role|Model
     */
    protected function findOrCreateRole($role): Role
    {
        return Role::query()->where('name', $role)->first() ?? factory(Role::class)->create(['name' => $role]);
    }
}
