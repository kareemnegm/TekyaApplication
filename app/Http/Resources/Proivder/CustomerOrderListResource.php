<?php

namespace App\Http\Resources\Proivder;

use App\Models\Invoices;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $totalInvoice=Invoices::where('user_id',$this->user_id)->sum('total_invoice');
        return [
           'user_id'=>$this->user_id,
           'total_order'=>$this->total,
           'total_shop_invoices'=>$totalInvoice,
           'name'=>$this->user->first_name.' '.$this->user->last_name,
           'gender '=>$this->user->gender,
           'mobile '=>$this->user->country_code .' '.$this->user->mobile

        ];
    }
}
