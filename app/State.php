<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
	
    // A state HAS MANY persons
    public function person() {
        return $this->hasMany('\App\Person'); // this matches the Eloquent model
    }
}
