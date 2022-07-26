<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_category_id', 'ar_title', 'en_title', 'image','is_visible'
    ];
    protected $appends = ['title'];


    public function MainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }

    public function Advertising()
    {
        return $this->hasMany(Advertising::class, 'sub_category_id');
    }

    public function getTitleAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->ar_title;
        } else {
            return $this->en_title;
        }
    }


    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/SubCategory') . '/' . $image;
        }
        return asset('uploads/SubCategory/default.jpg');

    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload_without_watermark($image, 'SubCategory');
            $this->attributes['image'] = $imageFields;
        }
    }
}
