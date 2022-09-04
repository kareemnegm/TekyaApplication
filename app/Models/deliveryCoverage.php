<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deliveryCoverage extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'shop_branch_id',
        'government_id',
        'area_id',
        'delivery_estimated_time',
        'delivery_fees',
        'notes',
        'delivery_date_time'
    ];

    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class, 'shop_id');
    }

    public function branch()
    {
        return $this->belongsTo(providerShopBranch::class, 'shop_branch_id');
    }

    public function government()
    {
        return $this->belongsTo(Government::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    
}
