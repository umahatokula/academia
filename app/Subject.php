<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function classes(){
        return $this->belongsToMany('\App\Class', 'class_subject', 'class_id', 'subject_id');
    }

    public function status(){
        return $this->belongsTo('\App\Status');
    }
}
