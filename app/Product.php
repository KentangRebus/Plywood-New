<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use UuidTrait;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

}
