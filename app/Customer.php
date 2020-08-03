<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use UuidTrait;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    public function transactions() {
        return $this->hasMany('App\TransactionHeader', 'customer_id', 'id');
    }

}
