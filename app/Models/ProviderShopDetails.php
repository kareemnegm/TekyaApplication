<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProviderShopDetails extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, FileTrait;
    protected $fillable = [
        'shop_name',
        'whatsapp_number',
        'facebook_link',
        'instagram_link', //shop or charity
        'email',
        'web_site',
        'provider_id',
        'category_id'

    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
}
