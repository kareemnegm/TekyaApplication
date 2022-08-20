<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Product extends Model implements HasMedia
{
    use HasFactory,HasTags,InteractsWithMedia , FileTrait;

    protected $mediaCollection = 'product_images';

    protected $fillable=[
        'name',
        'description',
        'price',
        'over_price',
        'start_date',
        'end_date',
        'stock_quantity',
        'is_published',
        'to_donation',
        'variant_id',
        'collection_id',
        'category_id',
    ];


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
}
