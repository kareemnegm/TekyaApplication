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
    protected $appends = ['Tags'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'over_price',
        'start_date',
        'end_date',
        'stock_quantity',
        'total_weight',
        'is_published',
        'to_donation',
        'variant_id',
        'collection_id',
        'category_id',
        'shop_id',
        'order'
    ];


    public function variant() {
        return $this->belongsTo(static::class, 'variant_id');
    }

     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function bundels(){
        return $this->belongsToMany(Bundel::class , 'bundel_products')->withTimestamps();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function shop(){
        return $this->belongsTo(ProviderShopDetails::class , 'shop_id');
    }

       /**
=======
    public function bundels()
    {
        return $this->belongsToMany(Bundel::class, 'bundel_products')->withTimestamps();
    }

    /**
>>>>>>> eff020e6fd156192dd46ffde6f06ba29f68090a6
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
