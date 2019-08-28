<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell_unit extends Model
{
    //
    protected $table = "sell_unit";

    public function packing()
    {
      return $this->hasMany('App\Packing', 'id');
    }

}
