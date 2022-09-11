<?php

namespace App\Models;
use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Collection extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia , FileTrait;

    protected $mediaCollection = 'collection_image';

    protected $fillable=[
        'name',
        'shop_id',
        'is_published',
        'admin_id'
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


    /**
     * Shop
     */
    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class,'shop_id');
    }

    

}
