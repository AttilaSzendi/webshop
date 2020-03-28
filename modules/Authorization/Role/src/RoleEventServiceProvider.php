<?php

namespace Modules\Authorization\Role;

use App\Providers\EventServiceProvider;
use Modules\Authorization\Role\Events\RoleGrantedToUserEvent;
use Modules\Authorization\Role\Events\RoleTakingAwayFromUserEvent;
use Modules\Authorization\Role\Listeners\RoleGrantedToUserEventListener;
use Modules\Authorization\Role\Listeners\RoleTakingAwayFromUserEventListener;

class RoleEventServiceProvider extends EventServiceProvider {

    /**
     * @var \string[][]
     */
    protected $listen = [
        RoleGrantedToUserEvent::class => [
            RoleGrantedToUserEventListener::class
        ],
        RoleTakingAwayFromUserEvent::class => [
            RoleTakingAwayFromUserEventListener::class
        ]
    ];
}