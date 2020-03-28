<?php

namespace Modules\Authorization\Role\Model;

use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Authorization\Permission\Model\Permission;
use Modules\User\Models\User;

/**
 * @property int id
 * @property string name
 * @property string translatable_name
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection users
 * @property Collection permissions
 */
class Role extends Model
{
    use Translatable;

    protected $translatedAttributes = ['name'];

    /** @return BelongsToMany */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /** @return BelongsToMany */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
