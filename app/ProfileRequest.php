<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileRequest extends Model
{
    protected $fillable = [
        'type', 'media_id', 'user_id', 'foreign_id', 'allow'
    ];
}
