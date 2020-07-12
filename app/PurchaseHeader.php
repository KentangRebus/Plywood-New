<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseHeader extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
    use UuidTrait;
    use SoftDeletes;

    protected $keyType = 'string';
    protected $softCascade = ['details'];
    public $incrementing = false;

    public function details() {
        return $this->hasMany('App\PurchaseDetail');
    }

}
