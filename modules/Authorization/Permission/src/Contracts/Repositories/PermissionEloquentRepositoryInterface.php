<?php

namespace Modules\Authorization\Permission\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface PermissionEloquentRepositoryInterface
{
    public function search($search): Collection;
}
