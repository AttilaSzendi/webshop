<?php

namespace Modules\Authorization\Role\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Authorization\Role\Contracts\Repositories\RoleRepositoryInterface;

class RoleSyncPermissionsController extends Controller
{
    /**
     * @var RoleRepositoryInterface
     */
    protected $repository;

    /**
     * UserSyncRolesController constructor.
     * @param RoleRepositoryInterface $repository
     */
    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $role = $this->repository->findById($request->input('roleId'));
        $permissionIds = $request->input('permissions');

        $this->repository->syncPermissions($role, $permissionIds);
    }
}
