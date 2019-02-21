<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function class()
    {
        return $this->hasOne('App\ClassMember');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function emails()
    {
        return $this->hasMany('App\Email');
    }

    public function contactNumbers()
    {
        return $this->hasMany('App\ContactNumber');
    }

    public function socialMedia()
    {
        return $this->hasMany('App\SocialMedia');
    }

    public function schools()
    {
        return $this->hasMany('App\SchoolRecord');
    }

    public function industries()
    {
        return $this->hasMany('App\IndustryRecord');
    }
}
