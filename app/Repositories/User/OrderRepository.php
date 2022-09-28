<?php

namespace App\Repositories\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CartProductResource;
use App\Http\Resources\User\OrderReviewResource;
use App\Http\Resources\User\UserCartResource;
use App\Interfaces\User\CartInterface;
use App\Interfaces\User\OrderInterface;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\Product;
use App\Models\ProviderShopDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderRepository extends Controller implements OrderInterface
{

    

      /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function orderReview($request){

        $shops=[];

        foreach($request['order_review']  as $review) {
            $cart_id = Auth::user()->cart->id;

            $shop= ProviderShopDetails::whereHas(
                'cart',
                function ($query) use ($cart_id,$review) {
                    $query->where('cart_id', $cart_id)->where('provider_shop_details_id', $review['shop_id']);
                }
            )->first();
            
            $shop['delivery_option_id']=$review['delivery_option_id'];

            if (isset($review['branch_id'])) {
                $shop['branch_id']=$review['branch_id'];
            } elseif (isset($review['address_id'])) {
                $shop['address_id']=$review['address_id'];
            }
            array_push($shops,$shop);
        }

        $orderResource=OrderReviewResource::collection($shops);
        $orderReview=collect($orderResource);

        return [
            'total_products_price'=>$orderReview->sum('total_price'),
            'total_taxes'=>$orderReview->sum('shop_taxes'),
            'total_shipping_fees'=>$orderReview->sum('shop_shipping_fees'),
            'total_shops'=>$orderReview->count(),
            'total_products'=>$orderReview->sum(function($value) {
                return count($value['products']);
            }),

            'order_review'=>$orderResource,
    
        ];

        
       return $shops;

    }


    /**
     * Place Order function
     *
     * @param [type] $projectId
     * @return void
     */
    public function placeOrder($req){


        $totalProducts=0;
        $totalPriceProduct=0;
        $totalShipments=0;
        $totalShop=0;



        foreach ($req['shops'] as $arr) {
            $totalProducts+= count($arr['products']);
            $totalShipments+= $arr['shipping_fees'];
            $totalShop+= 1;


          
            $totalShopItemPrice=0;
            $totalShopItem=0;

            $orderShopInvoice=[
                'coupon_id'=>$arr['id'],
                'shipment_fees'=>30,
                'discount'=>0,
                'total_product_price'=>$totalShopItemPrice,
                'total_invoice'=>$totalShopItemPrice + 30 - 0,
                'invoice_date'=>Carbon::now(),
            ];

            $orderShop=[
                'shop_id'=>$arr['id'],
                'delivery_option_id'=>$arr['delivery_option_id'],
                'total_items'=>$totalShopItem,

            ];

            $orderShopItems=[];



            foreach($arr['products'] as $product){


         
                $product=Product::where('is_published',1)->where('id',$product['id'])->firstOrFail();

                $price=$product->offer_price != 0 ? $product->offer_price : $product->price;


                $totalShopItem+=1;

                $totalShopItemPrice+=$price;
                $totalPriceProduct+= $price;

            }
        }

        $user_id=auth('user')->user()->id;
        $orderInvoice['user_id']=$user_id;
        $orderInvoice['shipping_fees']=$totalShipments;
        $orderInvoice['total_product_price']=$totalPriceProduct;
        $orderInvoice['tekya_wallet']=$req['tekya_wallet'];
        $orderInvoice['tekya_points']=$req['tekya_points'];
        $orderInvoice['taxes']=30;

        if($req['grand_total_price'] == $totalPriceProduct+$orderInvoice['taxes']+$totalShipments-$req['tekya_wallet']-$req['tekya_points']){

            $orderInvoice['grand_total_price']=$req['grand_total_price'];

            $latestOrderInvoiceCount = OrderInvoice::count();

            $orderInvoice['order_invoice_number'] = '#'.str_pad($latestOrderInvoiceCount+1, 8, "0", STR_PAD_LEFT);
    
            $grandInvoice=OrderInvoice::create($orderInvoice );

        }else{
    
            return $this->errorResponse('grand_total not equl the subtotal price with shiipment and taxes Must Be'
            .$totalPriceProduct+$orderInvoice['taxes']+$totalShipments-$req['tekya_wallet']-$req['tekya_points']
            ,422);
        }


        $orderDetails=$this->mainOrderDetails($user_id,$req['payment_id'],$totalProducts,$totalShop,$grandInvoice->id);
   
   
   
        foreach ($req['shops'] as $arr) {
           $this->shopsOrderInvoice($orderDetails->id,$arr);
        }
        // $this->shopsOrderInvoice($orderDetails->id,);

        // $this->shopsOrderDetails($orderDetails->id,);

        
        return $this->successResponse('sussfely Order');

    }


    private function mainOrderDetails($user_id,$payment_id,$totalProducts,$totalShop,$invoiceId){

        $order['date_order_placed']=Carbon::now();
        $order['user_id']=$user_id;
        $order['payment_id']=$payment_id;
        $order['total_items']=$totalProducts;
        $order['total_shop']=$totalShop;
        $order['order_invoice_id']=$invoiceId;

        $orderCount = Order::count();

        $order['order_number'] = '#'.str_pad($orderCount+1, 8, "0", STR_PAD_LEFT);

        $createOrder=Order::create($order);

        return $createOrder;
    }


    /**
     * Undocumented function
     *
     * @param [type] $orderId
     * @return void
     */
    private function shopsOrderInvoice($orderID,$shopDetails){
        $order['coupon_id']=$shopDetails->coupon_id;
        $order['discount']=0;
        $order['shipment_fees']=30;
        
        // $order['total_product_price']=$invoiceId;
        $order['invoice_date']=Carbon::now();

     
    }
    // private function shopsOrderDetails($orderId){
    //     $order['order_id']=$orderId;
    //     $order['shop_id']=$payment_id;
    //     $order['invoice_id']=$totalProducts;
    //     $order['delivery_option_id']=$totalShop;
    //     $order['total_items']=$invoiceId;
     
    // }
}



