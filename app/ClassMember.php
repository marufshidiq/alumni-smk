<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassMember extends Model
{
    protected $fillable = [
        'class_id'
    ];

    public function userDetails()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function classDetails()
    {
        return $this->hasOne('App\ClassList', 'id', 'class_id');
    }
}
