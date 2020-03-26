<?php

namespace Modules\User\Contracts\Repositories;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return array
     */
    public function permissions(int $userId): array;
}
