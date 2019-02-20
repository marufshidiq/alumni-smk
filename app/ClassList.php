<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassList extends Model
{
    public function yearInfo()
    {
        return $this->hasOne('App\EducationYearList', 'id', 'year_id');
    }

    public function majorInfo()
    {
        return $this->hasOne('App\MajorList', 'id', 'major_id');
    }
}
