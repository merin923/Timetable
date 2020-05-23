<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
* Many 
*
*/
class Course extends Model
{
    protected $guarded = [];

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
}
