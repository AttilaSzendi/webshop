<?php

namespace Modules\Authorization\Role\Listeners;

use Illuminate\Support\Facades\Storage;
use Modules\Authorization\Role\Events\RoleTakingAwayFromUserEvent;
use Modules\Authorization\Role\Models\Relations\RoleUser;

class RoleTakingAwayFromUserEventListener {

    public function handle(RoleTakingAwayFromUserEvent $event) {
        return;

        /** @var RoleUser $model */
        $model = $event->getModel();
        $user = $model->user;
        $role = $model->role;

        Storage::disk('local')->put('role_taking_away_from_user_event.txt',
            sprintf(
                'User: "%s" taking a way on this role: "%s" on this id: "%s"',
                $user->id,
                $role->name,
                $model->id
            )
        );
    }
}