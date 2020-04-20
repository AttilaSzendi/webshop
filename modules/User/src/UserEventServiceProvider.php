<?php

namespace Modules\User;

use App\Providers\EventServiceProvider;
use Modules\User\Events\UserHasRegistered;
use Modules\User\Listeners\SendEmailVerificationNotification;

class UserEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        UserHasRegistered::class => [
            SendEmailVerificationNotification::class
        ],
    ];
}
