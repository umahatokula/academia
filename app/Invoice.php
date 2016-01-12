<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    public function student(){
    	return $this->belongsTo('\App\Student');
    }

    public function status(){
    	return $this->belongsTo('\App\Status');
    }
}
