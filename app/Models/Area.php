<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'government_id'
    ];
    public function government(){
        return $this->belongsTo(Government::class);
    }
}
