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
    public function message(){
        return $this->hasMany(Message::class);
    }
    public function productsCarts()
    {
        return $this->belongsToMany(Product::class,'cart_product','product_id')->withPivot(['product_id ','quantity'])->withTimestamps();
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class,'cart_product','provider_shop_details_id')->withPivot(['product_id','quantity'])->withTimestamps();
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class ,'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'shop_id');
    }


    public function branches()
    {
        return $this->hasMany(providerShopBranch::class,'provider_shop_details_id');
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
