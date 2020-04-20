<?php

namespace Modules\User\Listeners;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\User\Events\UserHasRegistered;

class SendEmailVerificationNotification
{
    /**
     * @param UserHasRegistered $event
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }
}
