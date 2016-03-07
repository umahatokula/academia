<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentTerm extends Model
{
    protected $guarded = ['id'];

    protected $table = 'current_term';
}
