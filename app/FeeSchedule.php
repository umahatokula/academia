<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeSchedule extends Model
{
    protected $guarded = ['id'];

    protected $table = 'fee_schedules';
}
