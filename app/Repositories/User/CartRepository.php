<?php
namespace App\Repositories\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\CartProductResource;
use App\Http\Resources\User\UserCartResource;
use App\Interfaces\User\CartInterface;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartRepository extends Controller implements CartInterface
{

    /**
     * Add Product To Cart function
     *
     * @param [type] $req
     * @return void
     */
    public function addProductsToCart($req)
    {
        $cart_id = Auth::user()->cart->id;
        $product=Product::findOrFail($req['product_id']);

        $availableStock=$product->stock_quantity;

        $productInCart = CartProduct::where('cart_id',$cart_id)->where('product_id',$req['product_id'])->where('provider_shop_details_id',$req['shop_id'])->first();


        if ($availableStock <  $req['quantity']) {
            return $this->errorResponseWithMessage('Out Of Stock',422);
        }
        elseif($availableStock >  $req['quantity'] & !$productInCart){
    
        // $quantity=$req['quantity']   ?  :$req['quantity'];
    
            CartProduct::create([
            'cart_id'=> $cart_id, 
            'product_id'=> $req['product_id'], 
            'provider_shop_details_id'=> $req['shop_id'], 
            'quantity'=> $req['quantity'], 
            ]);
            return $this->successResponse('Product added in cart successfully.');

        }
            elseif($productInCart){

             $productInCart->updated(['quantity']);
             return $this->successResponse('Product updated in cart successfully.');

             
        }

    }

    /**
     * IncreaseOrDecreaseProduct function
     *
     * @param [type] $req
     * @return void
     */
    public function IncreaseOrDecreaseProductQuantity($req)
    {
        $cart_id = Auth::user()->cart->id;

        $productInCart = CartProduct::where('cart_id',$cart_id)->
        where('product_id',$req['product_id'])->where('provider_shop_details_id',$req['shop_id'])->first();


        $product=Product::findOrFail($req['product_id']);
        $availableStock=$product->stock_quantity;

        if ($availableStock <  $req['quantity']) {

            return $this->errorResponseWithMessage('Out Of Stock.',422);

        }elseif ($req['quantity'] == 0) {

            $productInCart->delete();
            return $this->successResponse('Product removed from cart successfully.');


        }elseif($availableStock >  $req['quantity'] && $productInCart){ 

            $productInCart->update(['quantity' => $req['quantity']]);
            return $this->successResponse('Product quantity updated successfully.');
        }
    }


    /**
     * Undocumented function
     *
     * @param [type] $cart_id
     * @return void
     */
    public function getCartProducts()
    {
        $cart_id = Auth::user()->cart->id;
        $cart  = Cart::findOrFail($cart_id);

        $cartUser = ProviderShopDetails::whereHas('cart',
                    function ($query) use($cart){$query->where('cart_id', $cart->id);})
                   ->distinct()
                    ->orderBy('created_at','DESC')->get();

            
            $countShop=count($cartUser);
            $countProducts=$cart->products()->count();
            $toalPrice=$cart->products()->sum('price');

       return [
        'cart_itmes'=>UserCartResource::collection($cartUser),
        'total_cart_shops'=>$countShop,
        'total_cart_products'=>$countProducts,
        'total_products_price'=>$toalPrice,
       ];
    }
}
