<?php

namespace Modules\User\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Modules\User\Notifications\VerifyEmail;
use Modules\Authorization\Role\Model\Role;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string remember_token
 * @property string registered_at
 * @property Carbon email_verified_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property  Collection roles
 */
class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable;

    protected $dates = ['email_verified_at'];

    protected $fillable = ['name', 'email', 'password', 'registered_at'];

    protected $hidden = ['password', 'remember_token'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
