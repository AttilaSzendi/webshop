<?php

namespace Modules\User\Contracts\Repositories;

use Modules\User\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function permissions(User $user): array;
}
