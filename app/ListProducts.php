<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListProducts extends Model
{
    protected $table = "list_product";

    public function product()
    {
        return $this->belongTo('App\Product');
    }

    public function teaser()
    {
        return $this->belongTo('App\Teaser');
    }

}
