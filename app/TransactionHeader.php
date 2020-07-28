<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHeader extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
    use UuidTrait;
    use SoftDeletes;

    protected $keyType = 'string';
    protected $softCascade = ['details'];
    public $incrementing = false;

    public function details() {
        return $this->hasMany('App\TransactionDetail', 'id', 'id');
    }

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

}
