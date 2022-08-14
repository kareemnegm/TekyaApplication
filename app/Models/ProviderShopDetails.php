<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderShopDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_name',
        'whatsapp_number',
        'facebook_link',
        'instagram_link', //shop or charity
        'email',
        'web_site',
        'image',
        'provider_id'

    ];
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
