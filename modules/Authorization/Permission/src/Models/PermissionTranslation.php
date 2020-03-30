<?php

namespace Modules\Authorization\Permission\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
