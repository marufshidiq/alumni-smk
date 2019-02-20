<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MajorList extends Model
{
    public function current()
    {
        return $this->hasOne('App\CurrentMajorList', 'id', 'current_major_id');
    }
}
