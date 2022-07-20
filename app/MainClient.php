<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainClient extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'id_num','type','email','image'
    ];

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('/')  . $image;
        }
        return asset('default_avatar.png');
    }


}
