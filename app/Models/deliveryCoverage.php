<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deliveryCoverage extends Model
{
    use HasFactory;
    /**
     * fillable variable
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'government_id',
        'area_id',
        'delivery_estimated_time',
        'delivery_fees',
        'notes',
    ];

    /**
     * Shop Related function
     *
     * @return void
     */
    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class, 'shop_id');
    }


    /**
     * Government Related function
     *
     * @return void
     */
    public function government()
    {
        return $this->belongsTo(Government::class, 'government_id');
    }

    /**
     * Area Related function
     *
     * @return void
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

}
