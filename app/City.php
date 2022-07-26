<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_title','en_title'
    ];

    protected $appends = ['title'];


    public function getTitleAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->ar_title;
        } else {
            return $this->en_title;
        }
    }
}
