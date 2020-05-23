<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
* One course
*
*/
class Course extends Model
{
    protected $guarded = [];

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
}
