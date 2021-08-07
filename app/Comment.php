<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function possts(){
        return $this->belongsTo(Posst::class);
    }


}
