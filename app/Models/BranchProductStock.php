<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProductStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'branch_id',
        'stock_qty'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function branch()
    {
        return $this->belongsTo(providerShopBranch::class, 'branch_id');
    }
}
