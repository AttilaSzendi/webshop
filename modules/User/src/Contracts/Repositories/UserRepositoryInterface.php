<?php

namespace Modules\User\Contracts\Repositories;

use Modules\User\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param array $attributes
     * @return User
     */
    public function store(array $attributes): User;

    /**
     * @param User $user
     * @return array
     */
    public function permissions(User $user): array;

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User;
}
