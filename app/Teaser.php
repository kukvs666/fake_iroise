<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teaser extends Model
{
    protected $table = "teaser";

    public function packing()
    {
        return $this->hasMany('App\Packing');
    }
}
