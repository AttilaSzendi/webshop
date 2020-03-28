<?php

namespace Modules\Authorization\Permission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Authorization\Permission\Contracts\Repositories\PermissionEloquentRepositoryInterface;
use Modules\Authorization\Permission\Resources\PermissionResource;

class PermissionIndexController extends Controller
{
    /**
     * @var PermissionEloquentRepositoryInterface
     */
    protected $repository;

    /**
     * PermissionIndexController constructor.
     * @param PermissionEloquentRepositoryInterface $repository
     */
    public function __construct(PermissionEloquentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        return PermissionResource::collection(
            $this->repository->search($request->get('search'))
        );
    }
}
