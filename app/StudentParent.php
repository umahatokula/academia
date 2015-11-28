<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Student;
use \App\Gender;
use \App\Religion;

class StudentParent extends Model
{
	use SoftDeletes;
	
    protected $table = 'parents';

	protected $guarded = ['id'];

    public function students(){
    	return $this->hasMany('\App\Student', 'parent_id', 'id');
    }

     public function gender(){
    	return $this->belongsTo('\App\Gender');
    }

     public function country(){
    	return $this->belongsTo('\App\Country');
    }


    public function state(){
    	return $this->belongsTo('\App\State');
    }


    public function local(){
    	return $this->belongsTo('\App\Local');
    }

     public function religion(){
        return $this->belongsTo('\App\Religion');
    }
}
