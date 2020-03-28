<?php

namespace Modules\Authorization\Role\Listeners;

use Illuminate\Support\Facades\Storage;
use Modules\Authorization\Role\Events\RoleGrantedToUserEvent;
use Modules\Authorization\Role\Models\Relations\RoleUser;

class RoleGrantedToUserEventListener {

    public function handle(RoleGrantedToUserEvent $event) {
        return;

        /** @var RoleUser $model */
        $model = $event->getModel();
        $user = $model->user;
        $role = $model->role;

        Storage::disk('local')->put('role_granted_to_user_event.txt',
            sprintf(
                'User: "%s" granted this role: "%s" on this id: "%s"',
                $user->id,
                $role->name,
                $model->id
            )
        );
    }
}