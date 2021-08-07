<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //

    public function possts(){
        return $this->belongsTo(Posst::class);
    }



}
