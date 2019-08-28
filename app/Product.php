<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function packing()
    {
      return $this->hasMany('App\Packing', 'products_id');
    }


}
