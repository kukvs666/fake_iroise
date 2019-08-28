<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gabarit extends Model
{
    //
    protected $table = "gabarit";

    public function calibre()
    {
      return $this->hasMany('App\Calibre', 'gabarit_id');
    }

}
