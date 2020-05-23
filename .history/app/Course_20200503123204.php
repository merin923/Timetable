<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
* One course many teachers
*
*/
class Course extends Model
{
    protected $guarded = [];

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
}
