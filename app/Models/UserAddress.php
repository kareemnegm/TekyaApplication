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
        'street,
        address_details',
        'nearest_landMark',
        'notes',
        'is_default',
        'area'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}
