<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeSchedule extends Model
{
    public function studentClass(){
    	return $this->belongsTo('\App\StudentClass', 'class_id', 'id');
    }

    public function term(){
    	return $this->belongsTo('\App\Term', 'term_id', 'id');
    }

    public function feeElement(){
    	return $this->belongsTo('\App\feeElement');
    }

    public function status(){
    	return $this->belongsTo('\App\Status');
    }
}
