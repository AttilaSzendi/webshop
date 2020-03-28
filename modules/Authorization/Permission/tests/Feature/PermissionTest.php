<?php

namespace Modules\Authorization\Permission\Tests\Feature;

use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Modules\Authorization\Permission\Model\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    /**
     * @test
     */
    public function permissions_should_be_listed_from_the_permissions_table()
    {
        $admin = $this->userUtilities->createUserWithRoleAndPermissions('admin', ['permission-index']);

        Passport::actingAs($admin);

        factory(Permission::class)->create(['key' => 'category-delete']);
        factory(Permission::class)->create(['key' => 'user-create']);
        factory(Permission::class)->create(['key' => 'user-update']);

        $response = $this->json('GET', route('permission-index'));

        $response->assertJsonCount(4, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        "id",
                        "name",
                    ]
                ]
            ])->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function permissions_should_not_be_listed_if_user_has_no_permission_for_the_action()
    {
        $userWithoutPermissions = factory(User::class)->create();

        Passport::actingAs($userWithoutPermissions);

        factory(Permission::class)->create(['name' => 'category-delete', 'translatable_name' => 'category-delete']);
        factory(Permission::class)->create(['name' => 'user-create', 'translatable_name' => 'user-create']);
        factory(Permission::class)->create(['name' => 'user-update', 'translatable_name' => 'user-update']);

        $response = $this->json('GET', route('permission-index'));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function permissions_should_be_filtered()
    {
        $admin = $this->userUtilities->createUserWithRoleAndPermission('admin', 'permission-index');

        Passport::actingAs($admin);

        factory(Permission::class)->create(['name' => 'category-delete', 'translatable_name' => 'category-delete']);
        factory(Permission::class)->create(['name' => 'user-create', 'translatable_name' => 'user-create']);
        factory(Permission::class)->create(['name' => 'user-update', 'translatable_name' => 'user-update']);

        $search = ['search' => 'user-'];

        $response = $this->json('GET', route('permission-index', $search));

        $response->assertJsonCount(2, 'data')
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
