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
    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function government()
    {
        return $this->belongsTo(Government::class)->select('id','name');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function area()
    {
        return $this->belongsTo(Area::class)->select('id','name','description');;
    }
}
