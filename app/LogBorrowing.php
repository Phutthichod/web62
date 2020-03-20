<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogBorrowing extends Model
{
    protected $table = "log_borrowing";

    public function BorrowingList()
    {
        return $this->hasOne('App\borrowingList','borrowing_id');
    }
}
