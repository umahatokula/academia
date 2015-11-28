<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\StudentClass;
use \App\StudentParent;
use \App\Gender;
use \App\Religion;

class Student extends Model
{
	use SoftDeletes;
	
    protected $guarded = ['id'];

    public function studentClass(){
    	return $this->belongsTo('\App\StudentClass', 'class_id', 'id');
    }



    public function studentParent(){
    	return $this->belongsTo('\App\StudentParent', 'parent_id', 'id');
    }


    public function gender(){
    	return $this->belongsTo('\App\Gender', 'gender_id', 'id');
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
