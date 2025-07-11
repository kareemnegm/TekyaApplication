<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'longitude',
        'latitude',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
