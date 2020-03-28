<?php

namespace Modules\Authorization\Role\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Authorization\Role\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Authorization\Role\Resources\RoleResource;

class RoleIndexController extends Controller
{
    /**
     * @var RoleRepositoryInterface
     */
    protected $roleRepository;

    /**
     * RoleIndexController constructor.
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke()
    {
        return RoleResource::collection(
            $this->roleRepository->findAll()
        );
    }
}
