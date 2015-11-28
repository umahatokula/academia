<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use \App\Person;
// use \App\Role;
// use \App\User;
use \App\Church;
// use \App\Helpers\Helper;

class Status extends Model
{
	use SoftDeletes;
	
    protected $table = 'status';

    public function church(){
    	return $this->hasMany('\App\Church');
    }
}
