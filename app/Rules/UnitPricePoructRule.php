<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UnitPricePoructRule implements Rule
{
    public $request;
    public $array;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request=$request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {


        Validator::extend($value, function($attribute, $value, $parameters, $validator) {
            // $rule = new EmptyIf($parameters[0]);

            dd('s');
            // return $rule->passes();
        });
        dd($value);

        $error=[];
      
        foreach($value as $key=>$product ){

        $priceProduct=Product::where('id',$product['id'])->select(['price','offer_price'])->first();

        // dd($priceProduct->price,$product['unit_price']);

        // dd($priceProduct->offer_price , $product);
        if($priceProduct->offer_price == $product['unit_price'] ||
           $priceProduct->price == $product['unit_price'] ){
            
         }else{
            // dd($priceProduct->price,$product['unit_price']);

            $error[] = "The :$attribute.$key. must be same same unit price";
          }


        }



        // $validator = Validator::make(Input::all(), $rules, $messages);

        dd($error);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return [
        //     'title.reuired' => 'A nice title is required for the post.',
        //     'body.required' => 'Please add content for the post.',
        // ];
        // return 'The :attribute must be uppercase. End expired: ' . $this->err;
        return 'The :attribute must be same same unit price';

        // return 'The product price not same unit price message.';
    }
}
