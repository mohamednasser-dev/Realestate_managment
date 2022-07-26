<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    use HasFactory;

    protected $fillable = [
        'ar_title', 'en_title', 'image', 'is_visible',
        'ar_description', 'en_description', 'lat', 'lng',
        'is_favorite', 'space', 'price', 'soom',
        'peace_number', 'view', 'rooms_count', 'main_category_id',
        'sub_category_id', 'city_id', 'district_id', 'created_by',
        'video_link', 'build_area', 'build_age',
    ];

    protected $appends = ['title', 'description'];

    public function images()
    {
        return $this->hasMany(AdvertisingImages::class, 'advertising_id');

    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');

    }


    public function getTitleAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->ar_title;
        } else {
            return $this->en_title;
        }
    }


    public function getDescriptionAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->ar_description;
        } else {
            return $this->en_description;
        }
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/Advertising') . '/' . $image;
        }

        return asset('uploads/Advertising/default.jpg');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'Advertising');
            $this->attributes['image'] = $imageFields;
        }
    }


    public function MainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function District()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
