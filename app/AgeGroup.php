<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgeGroup extends Model
{
	use SoftDeletes;
	
    // An age group HAS MANY persons
    public function person() {
        return $this->hasMany('\App\Person'); // this matches the Eloquent model
    }
}
