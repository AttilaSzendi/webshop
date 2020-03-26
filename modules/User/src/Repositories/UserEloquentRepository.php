<?php

namespace Modules\User\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Booking\Models\Booking;
use Modules\Profile\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Repositories\AbstractEloquentCrudRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\AdvertisementOwner\Models\AdvertisementPermission;
use Modules\User\Contracts\Repositories\UserRepositoryInterface;
use Modules\User\Models\User;

class UserEloquentRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $userId
     * @return array
     */
    public function permissions(int $userId): array
    {
        $permissionList = [];

        $user = $this->model->newQuery()->where('id', $userId)->with('roles.permissions')->first();

        foreach ($user->roles as $role) {
            $permissionList = $this->permissionsOfUserRoles($role, $permissionList);
        }

        return $permissionList;
    }
}
