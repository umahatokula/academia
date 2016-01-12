<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = ['id'];

    public function bank(){
    	return $this->belongsTo('\App\Bank');
    }
}
