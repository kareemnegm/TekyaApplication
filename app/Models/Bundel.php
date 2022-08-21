<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Bundel extends Model implements HasMedia
{
    use HasFactory,HasTags, InteractsWithMedia , FileTrait;

    protected $mediaCollection = 'bundel_images';

    protected $fillable=[
        'name',
        'description',
        'price',
        'over_price',
        'start_date',
        'end_date',
        'stock_quantity',
        'is_published',
        'is_delivery',
        'is_pickup',
        'collection_id',
        'category_id',
    ];
}
