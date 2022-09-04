<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'street',
        'address_details',
        'nearest_landmark',
        'notes',
        'area_id',
        'government_id',
    ];
    public function providerShopBranch()
    {
        return $this->hasOne(providerShopBranch::class);
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
