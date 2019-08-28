<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    //
    protected $table = "packing";

    public function list_product()
    {
        return $this->belongTo('App\ListProducts');
    }


    public function sell_unit()
    {
      return $this->belongTo('App\Sell_unit');
    }

}

