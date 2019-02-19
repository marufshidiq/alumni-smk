<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolRecord extends Model
{
    protected $fillable = [
        'school_id', 'grade', 'major', 'start', 'end'
    ];

    public function schoolDetail()
    {
        return $this->hasOne('App\SchoolList', 'id', 'school_id');
    }
}
