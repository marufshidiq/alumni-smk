<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = [
        'username', 'privacy', 'media'
    ];

    public function details()
    {
        return $this->hasOne('App\SocialMediaList', 'id', 'media');
    }

    public function link()
    {
        $details = $this->details;
        $link = str_replace("{username}", $this->username, $details['url']);
        return $link;        
    }
}
