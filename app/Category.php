<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use UuidTrait;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;
}
