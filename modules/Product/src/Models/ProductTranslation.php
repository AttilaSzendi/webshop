<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string description
 * @property int price
 */
class ProductTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description'];
}
