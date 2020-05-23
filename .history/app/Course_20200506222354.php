<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*php artisan serve
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
