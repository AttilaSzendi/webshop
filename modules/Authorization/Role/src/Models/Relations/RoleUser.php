<?php

namespace Modules\Authorization\Role\Models\Relations;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Authorization\Role\Events\RoleGrantedToUserEvent;
use Modules\Authorization\Role\Events\RoleTakingAwayFromUserEvent;
use Modules\Authorization\Role\Model\Role;
use Modules\Core\Enum\EloquentModelEvent;

/**
 * @property int    role_id
 * @property int    user_id
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property User   user
 * @property Role   role
 */
class RoleUser extends Pivot {

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var string
     */
    protected $table = 'role_user';

    protected $dispatchesEvents = [
        EloquentModelEvent::CREATED => RoleGrantedToUserEvent::class,
        EloquentModelEvent::DELETED => RoleTakingAwayFromUserEvent::class,
    ];

    /**
     * @inheritDoc
     */
    protected static function boot() {
        parent::boot();

        self::created(function($model) {
            /** @var RoleUser $model */

        });
        self::updated(function ($model) {
            /** @var RoleUser $model */

        });
        self::deleted(function ($model) {
            /** @var RoleUser $model */
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|User|NULL
     */
    public function user() {
        return $this->hasOne(User::class,'id',  'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Role|NULL
     */
    public function role() {
        return $this->hasOne(Role::class,'id',  'role_id');
    }
}