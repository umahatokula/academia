<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Student;
use \App\Staff;

class StudentClass extends Model
{
	use SoftDeletes;
	
	protected $table = 'classes';

	protected $guarded = ['id'];

    public function students(){
    	return $this->hasMany('\App\Student');
    }

    public function staff(){
    	return $this->belongsTo('\App\Staff');
    }

    public function subjects(){
        return $this->belongsToMany('\App\Subject', 'class_subject', 'class_id', 'subject_id');
    }
}
