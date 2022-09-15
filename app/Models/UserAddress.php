<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'user_id',
        're_name',
        're_mobile',
        'street',
        'address_details',
        'nearest_landmark',
        'notes',
        'is_default',
        'area_id',
        'government_id',
        'latitude',
        'longitude',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
