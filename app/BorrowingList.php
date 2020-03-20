<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowingList extends Model
{
    protected $table = "borrowing_list";
    public $timestamps = false;
    public function member()
    {
        return $this->hasOne('App\Member');
    }
    function borrowingLists(){
        return $this->belongsTo('App\Borrowing');
    }
    public function logs()
    {
        return $this->belongsTo('App\LogBorrowing');
    }
    public function alerts()
    {
        return $this->belongsTo('App\Alert');
    }
}
