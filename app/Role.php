<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	
	//A role may have many users
    public function users(){
     return $this->belongsToMany('\App\User', 'role_users');
    }

}
