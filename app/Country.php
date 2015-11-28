<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
	
	// country HAS MANY persons
    public function person(){
    	return $this->hasMany('\App\Person');
    }
}
