<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustryRecord extends Model
{
    protected $fillable = [
        'industry_id', 'position', 'division', 'start', 'end'
    ];

    public function industryDetail()
    {
        return $this->hasOne('App\IndustryList', 'id', 'industry_id');
    }
}
