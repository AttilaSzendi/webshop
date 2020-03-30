<?php

namespace Modules\Authorization\Permission\Tests\Feature;

use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Modules\Authorization\Permission\Model\Permission;
use Modules\User\Models\User;
use Tests\TestCase;

class PermissionIndexTest extends TestCase
{
    /**
     * @test
     */
    public function permissions_cannot_be_listed_without_permission()
    {
        $userWithoutPermissions = factory(User::class)->create();

        Passport::actingAs($userWithoutPermissions);

        $response = $this->json('GET', route('permission-index'));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function permissions_can_be_listed_with_permission()
    {
        $admin = $this->userUtilities->createUserWithRoleAndPermissions('admin', ['permission-index']);

        Passport::actingAs($admin);

        $otherPermissions = factory(Permission::class, 2)->create();

        $response = $this->json('GET', route('permission-index'));

        $response->assertJsonCount(1 + $otherPermissions->count(), 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        "id",
                        "key",
                    ]
                ]
            ])->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function permissions_should_be_filtered()
    {
        $admin = $this->userUtilities->createUserWithRoleAndPermissions('admin', ['permission-index']);

        Passport::actingAs($admin);

        factory(Permission::class)->create(['key' => 'category-delete']);
        factory(Permission::class)->create(['key' => 'user-create']);
        factory(Permission::class)->create(['key' => 'user-update']);

        $search = ['search' => 'user-'];

        $response = $this->json('GET', route('permission-index', $search));

        $response->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        "id",
                        "key",
                    ]
                ]
            ])->assertStatus(Response::HTTP_OK);
    }
}
