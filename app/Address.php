<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address', 'province', 'city', 'district', 'privacy'
    ];

    public function provinceDetails()
    {
        return $this->hasOne('Laravolt\Indonesia\Models\Province', 'id', 'province');
    }
    
    public function cityDetails()
    {
        return $this->hasOne('Laravolt\Indonesia\Models\City', 'id', 'city');
    }

    public function districtDetails()
    {
        return $this->hasOne('Laravolt\Indonesia\Models\District', 'id', 'district');
    }
}
