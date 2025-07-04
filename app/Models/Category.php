<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id'
    ];

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }

    public function providerShopDetails()
    {
        return $this->belongsToMany(ProviderShopDetails::class,'category_shops');
    }
    public function parent()
    {
        return $this->belongsTo(static::class, 'category_id');
    }
    public function children()
    {
        return $this->hasMany(static::class, 'category_id');
    }
    public function subs()
    {
        return $this->children()->with(['subs']);
    }

    public function shops()
    {
        return $this->belongsToMany(ProviderShopDetails::class, 'category_shops','category_id','shop_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
