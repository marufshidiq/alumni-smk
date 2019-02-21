<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MajorList extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'short_name'
            ]
        ];
    }

    public function current()
    {
        return $this->hasOne('App\CurrentMajorList', 'id', 'current_major_id');
    }
}
