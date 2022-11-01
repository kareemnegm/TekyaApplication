<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\Provider\ProductBranch\BranchResource;
use App\Models\providerShopBranch;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductBranchStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $branch=providerShopBranch::where('id',$this->branch_id)->first();

        return [
            'id'=>$this->id,
            'product_id'=>$this->product_id,
            'stock_quantity'=>$this->stock_qty,
            'branch'=>new BranchResource($branch)
        ];
    }
}
