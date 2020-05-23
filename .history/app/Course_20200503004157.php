<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
* Many courses ca belong to one teacher
*
*/
class Course extends Model
{
    protected $guarded = [];

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
}
