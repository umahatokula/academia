<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeElement extends Model
{
	protected $table = 'fee_elements';
	
    protected $guarded = ['id'];

    public function status(){
        return $this->belongsTo('\App\Status');
    }
}
