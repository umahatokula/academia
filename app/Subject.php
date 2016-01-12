<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Subject extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function classes(){
        return $this->belongsToMany('\App\Class', 'class_subject', 'class_id', 'subject_id');
    }

    public function staff(){
        return $this->belongsToMany('\App\Subject', 'class_subject', 'staff_id', 'subject_id');
    }

    public function status(){
        return $this->belongsTo('\App\Status');
    }

    public static function getSubjectTeacher($class_id, $subject_id){
        $return = DB::table('class_subject')->where(['class_id'=>$class_id, 'subject_id'=>$subject_id])->join('staff', 'staff.id', '=', 'class_subject.staff_id')->first();
        return $return;

    }
}
