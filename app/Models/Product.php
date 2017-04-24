<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use MongoModel;

/**
 * Class Product
 *
 * @mixin \Eloquent
 */

class Product extends MongoModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
