<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/** 
 * 
 * Returns Teacher that belongs to clas
 * 
 */



class Teacher extends Model
{
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class);
    }

}
