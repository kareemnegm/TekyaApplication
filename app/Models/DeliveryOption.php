<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'shipment_type',
        'option'
    ];
}
