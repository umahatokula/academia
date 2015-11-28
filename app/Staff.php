<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Staff extends Model
{
    use SoftDeletes;
    
    protected $table='staff';

    protected $guarded = ['id'];

    public function classes(){
        return $this->hasMany('\App\StudentClass');
    }

    public function gender(){
    	return $this->belongsTo('\App\Gender');
    }


    public function staffType(){
    	return $this->belongsTo('\App\StaffType');
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
}
