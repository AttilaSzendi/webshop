<?php

namespace Modules\Authorization\Permission\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Authorization\Permission\Contracts\Repositories\PermissionEloquentRepositoryInterface;
use Modules\Authorization\Permission\Model\Permission;

class PermissionEloquentRepository implements PermissionEloquentRepositoryInterface
{
    /** @var Permission */
    protected $model;

    /** @param Permission $model */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * @param $search
     * @return Collection
     */
    public function search($search): Collection
    {
        return $this->model
            ->newQuery()
            ->when($search, function (Builder $query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->select('id', 'name')
            ->get();
    }
}
