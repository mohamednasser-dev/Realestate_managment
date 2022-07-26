<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_title','en_title','image','is_visible'
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



    public function SubCategories()
    {
        return $this->hasMany(SubCategory::class, 'main_category_id');
    }

    public function Advertising()
    {
        return $this->hasMany(Advertising::class, 'main_category_id');
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/MainCategory') . '/' . $image;
        }
        return asset('uploads/MainCategory/default.jpg');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload_without_watermark($image, 'MainCategory');
            $this->attributes['image'] = $imageFields;
        }
    }


    protected function castAttribute($key, $value)
    {
        if ($this->getCastType($key) == 'string' && is_null($value)) {
            return '';
        }


        return parent::castAttribute($key, $value);
    }
}
