<?php

namespace Modules\Authorization\Role\Model;

use Illuminate\Database\Eloquent\Model;


class RoleTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
