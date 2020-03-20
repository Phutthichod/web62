<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagories extends Model
{
    protected $table = "catagories";

    public function accessories()
    {
        return $this->belongsTo('App\Accessories');
    }
}
