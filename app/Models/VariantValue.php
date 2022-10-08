<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'product_variant_id',
        'is_default'
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
