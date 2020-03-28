<?php

namespace Modules\Authorization\Role\Tests\Feature;

use Tests\LocalizedTestCase;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Modules\Authorization\Role\Model\Role;
use Modules\Authorization\Permission\Model\Permission;

class RoleTest extends LocalizedTestCase
{
    /**
     * @test
     */
    public function permissions_could_be_synced_to_a_role()
    {
        $admin = $this->userUtilities->createUserWithRoleAndPermission('admin', 'sync-permissions');
        $role = factory(Role::class)->create();
        $permissions = factory(Permission::class, 3)->create();

        $data = [
            'roleId' => $role->id,
            'permissions' => [$permissions[0]->id, $permissions[1]->id, $permissions[2]->id]
        ];

        Passport::actingAs($admin);

        $response = $this->json('POST', route('admin::sync-permissions'), $data);

        foreach ($permissions as $permission) {
            $this->assertDatabaseHas('permission_role', [
                'permission_id' => $permission->id,
                'role_id' => $role->id,
            ]);
        }

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function roles_should_be_listed_from_the_roles_table()
    {
        $admin = $this->userUtilities->createUserWithRoleAndPermission('admin', 'role-index');

        Passport::actingAs($admin);

        $roles = factory(Role::class, 3)->create();

        $response = $this->json('GET', route('admin::role-index'));

        $response->assertJsonCount($roles->count() + 1, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        "id",
                        "name",
                    ]
                ]
            ])->assertStatus(Response::HTTP_OK);
    }
}
