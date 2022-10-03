<?php

namespace App\Repositories\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CartProductResource;
use App\Http\Resources\User\OrderReviewResource;
use App\Http\Resources\User\PaymentOptionResource;
use App\Http\Resources\User\UserCartResource;
use App\Interfaces\User\CartInterface;
use App\Interfaces\User\OrderInterface;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\DeliveryOption;
use App\Models\Invoices;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\OrderItem;
use App\Models\OrderPickup;
use App\Models\OrderShipment;
use App\Models\OrderShop;
use App\Models\PaymentOption;
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
    public function orderReview($request)
    {
        $shops=[];

        foreach ($request['order_review']  as $review) {
            $cart_id = Auth::user()->cart->id;

            $shop= ProviderShopDetails::whereHas(
                'cart',
                function ($query) use ($cart_id, $review) {
                    $query->where('cart_id', $cart_id)->where('provider_shop_details_id', $review['shop_id']);
                }
            )->first();

            $shop['delivery_option_id']=$review['delivery_option_id'];

            if (isset($review['branch_id'])) {
                $shop['branch_id']=$review['branch_id'];
            } elseif (isset($review['address_id'])) {
                $shop['address_id']=$review['address_id'];
            }
            array_push($shops, $shop);
        }

        $orderResource=OrderReviewResource::collection($shops);
        $orderReview=collect($orderResource);


        $payment=PaymentOption::FindOrFail($request['payment_id']);


        return [

            'total_products_price'=>$orderReview->sum('total_price'),
            'total_taxes'=>$orderReview->sum('shop_taxes'),
            'total_shipping_fees'=>$orderReview->sum('shop_shipping_fees'),
            'total_shops'=>$orderReview->count(),
            'payment_option'=>$orderReview->count(),

            'total_products'=>$orderReview->sum(function ($value) {
                return count($value['products']);
            }),

            'payment_option'=> new PaymentOptionResource($payment),

            'order_review'=>$orderResource


        ];


        return $shops;
    }


    /**
     * Place Order function
     *
     * @param [type] $projectId
     * @return void
     */
    public function placeOrder($req)
    {
    $user = Auth::user();
    // $products=CartProduct::where('cart_id',$user_id->cart->id)->get();

    $userCart=CartProduct::with(['shop','product'])->where('cart_id', $user->cart->id)->get();
    // dd($userCart);

    if ($this->productsAreNoLongerAvailable($userCart)) {
        return $this->errorResponseWithMessage('Sorry! One of the items in your cart is no longer avialble.', 422);
    }


    $date=Carbon::now();



    //    $totalShopItemPrice=0;
    //    $taxes=0;
    //    $shopShpping=0;
    $total_items=$userCart->count();
    $total_shop=$userCart->unique('provider_shop_details_id')->count();

    //     foreach($req['shops'] as $shopItem){
    //         $userCart=CartProduct::with(['shop','product'])->where('cart_id',$user->cart->id)->where('provider_shop_details_id',$shopItem['id'])->get();

    //         $totalShopItemPrice+=$userCart->sum(function($product) {
    //             return $product->product->order_price;
    //         });

    //         if($userCart->first()->shop->vat == 0){
    //          $taxes+= round(($userCart->sum(function($product) {
    //             return $product->product->order_price;
    //         })*14/100),2);
    //         }

    //         $shopShpping+=30;
    //     }

    // $orderInvoice =[
        //     'total_product_price'=>$totalShopItemPrice,
        //     'tekya_wallet'=>null,
        //     'tekya_points'=>null,
        //     'user_id'=>$user->id,
        //     'shipping_fees'=>$shopShpping,
        //     'taxes'=>$taxes,
        //     'grand_total_price'=>$totalShopItemPrice+$taxes+$shopShpping,
    // ];

    // $latestOrderInvoiceCount = OrderInvoice::count();
    // $orderInvoice['order_invoice_number'] = '#'.str_pad($latestOrderInvoiceCount+1, 8, "0", STR_PAD_LEFT);
    // $orderInvoice=OrderInvoice::create($orderInvoice);
    DB::beginTransaction();
    try {
        $order =[
        'date_order_placed'=>$date,
        'user_id'=>$user->id,
        'payment_id'=>$req['payment_id'],
        'total_items'=>$total_items,
        'total_shop'=>$total_shop ,
        // 'order_invoice_id'=>$orderInvoice->id,
            ];

        $orderCount = Order::count();
        $order['order_number'] = '#'.str_pad($orderCount+1, 8, "0", STR_PAD_LEFT);
        $createOrder=Order::create($order);

        /**
         *
         */

        $totalShopItemPrice=0;
        $taxes=0;
        $totalShipping=0;

        foreach ($req['shops'] as $shopItem) {
            $shopItems=CartProduct::with(['shop','product'])->where('cart_id', $user->cart->id)->where('provider_shop_details_id', $shopItem['id'])->get();


            $shopItemsPrice=$shopItems->sum(function ($product) {
                return $product->product->order_price;
            });

            $totalShopItemPrice+=$shopItemsPrice;

            if ($shopItems->first()->shop->vat == 0) {
                $shopTaxes= round(($shopItemsPrice*14/100), 2);
                $taxes+=$shopTaxes;
            }

            $shopShpping=30;
            $totalShipping+=$shopShpping;

            $orderShopInvoice =[
                'coupon_id'=>null,
                'shipment_fees'=>30,
                'discount'=>0,
                'total_product_price'=>$shopItemsPrice,
                'total_invoice'=>$shopItemsPrice + $shopShpping - 0,
                'invoice_date'=>$date,
                "taxes"=>$shopTaxes
            ];

            $shopInvoice=Invoices::create($orderShopInvoice);

            $orderShop =[
                'order_id'=>$createOrder->id,
                'shop_id'=>$shopItem['id'],
                'invoice_id'=>$shopInvoice->id,
                'delivery_option_id'=>$shopItem['delivery_option_id'],
                'total_items'=>$shopItems->count(),
                'note'=>null,
            ];

            $shopShop=OrderShop::create($orderShop);

            $deliveryOption=DeliveryOption::findOrFail($shopItem['delivery_option_id']);


            if ($deliveryOption->shipment_type  == 'address') {
                $orderShop =[
                    'order_shop_id'=>$shopInvoice->id,
                    'address_id'=>$shopItem['address_id'],
                ];
                $shopInvoice=OrderShipment::create($orderShop);
            } elseif ($deliveryOption->shipment_type  == 'branch') {
                $orderShop =[
                    'order_shop_id'=>$shopInvoice->id,
                    'branch_id'=>$shopItem['branch_id'],
                ];

                $shopInvoice=OrderPickup::create($orderShop);
            }


            foreach ($shopItems as $shopProduct) {
                $product =[
                    'order_shop_id'=>$shopShop->id,
                    'product_id'=>$shopProduct->product->id,
                    'quantity'=>$shopProduct->quantity,
                    'unit_price'=>$shopProduct->product->order_price,
                    'unit_total'=>$shopProduct->product->order_price*$shopProduct->quantity,
                ];

                OrderItem::create($product);
                // $shopProduct->product->stock_quantity-=$shopProduct->quantity;
                // $shopProduct->product->save();
            }
        }

        $orderInvoice =[
            'total_product_price'=>$totalShopItemPrice,
            'tekya_wallet'=>null,
            'tekya_points'=>null,
            'user_id'=>$user->id,
            'shipping_fees'=>$totalShipping,
            'taxes'=>$taxes,
            'grand_total_price'=>$totalShopItemPrice+$taxes+$shopShpping,
        ];


        $latestOrderInvoiceCount = OrderInvoice::count();
        $orderInvoice['order_invoice_number'] = '#'.str_pad($latestOrderInvoiceCount+1, 8, "0", STR_PAD_LEFT);
        $orderInvoice=OrderInvoice::create($orderInvoice);

        $createOrder->update(['order_invoice_id'=>$createOrder->id]);
        DB::commit('Make Order');

        return $this->successResponse('sussfely Order');

    }

        catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
}
    

    private function mainOrderDetails($user_id,$orderData){

        $order['date_order_placed']=Carbon::now();
        $order['user_id']=$user_id;
        $order['payment_id']=$orderData['payment_id'];
        $order['total_items']=$orderData['totalProducts'];
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

    /**
     * Check If Products Aviliable With Stock function
     *
     * @return void
     */
    protected function productsAreNoLongerAvailable($products)
    {

        foreach ($products as $item) {
            $product = Product::find($item->product_id);
            if ($product->stock_quantity < $item->quantity) {
                return true;
            }
        }

        return false;
    }
}



