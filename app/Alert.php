<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = "alert";
    public $timestamps = false;
    function member(){
        return $this->hasOne('App\Member','user_id');
    }
    function borrowingList(){
        return $this->hasOne('App\BorrowingList','borrowing_list_id');
    }
}
