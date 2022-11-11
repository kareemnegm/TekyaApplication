<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'discount_cap',
        'discount',
        'shop_id',
        'category_id',
        'branch_id',
        'price_range_start',
        'price_range_end'
    ];
    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class, 'shop_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function providerShopBranch()
    {
        return $this->belongsTo(providerShopBranch::class);
    }
}
