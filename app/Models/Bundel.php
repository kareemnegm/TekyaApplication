<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Bundel extends Model implements HasMedia
{
    use HasFactory,HasTags, InteractsWithMedia , FileTrait;

    protected $mediaCollection = 'bundel_images';
    protected $appends = ['Tags'];


    protected $fillable=[
        'name',
        'description',
        'price',
        'offer_price',
        'start_date',
        'end_date',
        'stock_quantity',
        'total_weight',
        'is_published',
        'is_delivery',
        'is_pickup',
        'category_id',
        'order',
        'shop_id'
    ];

    /**
     * Products List function
     *
     * @return array
     */
    public function products(){
        return $this->belongsToMany(Product::class , 'bundel_products')->withTimestamps();
    }


    /**
     * Category Object function
     *
     * @return Object
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }


         /**
     * Undocumented function
     *
     * @param Media $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(400)
              ->height(600)
              ->sharpen(0);
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function getTagsAttribute()
    {
        return $this->tags()->get();
    }

}
