<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    //
    public $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'ip_address',
        'product_quantity',

    ];

    // one to one relation 
     
    public function user(){

        return $this->belongsTo(User::class);
    }

    // one to one relation 
     
    public function order(){

        return $this->belongsTo(Order::class);
    }
    // one to one relation 
     
    public function product(){

        return $this->belongsTo(Product::class);
    }
  
/*    
    // count total product items that added by a user 
    public static function totalItems(){
        # if user is authenticated
        if(Auth::check()){
            $carts = Cart::where('user_id', Auth::id())
                         //->orWhere('ip_address',request()->ip())
                         ->where('order_id',NULL)
                         ->get();
        }else{
            $carts = Cart::where('ip_address', request()->ip())
                         ->where('order_id',NULL)
                         ->where('user_id',NULL)
                         ->get();
        }
        $total_item = 0;
        foreach($carts as $cart){
            $total_item += $cart->product_quantity;
        }
        return $total_item;  // return total no of items that added by a user
    }

        // total cart show of an user
        public static function totalCart(){
            # if user is authenticated
            if(Auth::check()){
                $carts = Cart::where('user_id', Auth::id())
                             ->where('order_id',NULL)
                             ->get();
            }else{
                $carts = Cart::where('ip_address', request()->ip())
                             ->where('order_id',NULL)
                             ->where('user_id',NULL)
                             ->get();
            }
            return $carts;  // return total cart 
        }

     */ 
    
    public static function totalCart(){
        # if user is authenticated
        if(Auth::check()){
            $carts = Cart::where('user_id', Auth::id())
                         ->orWhere('ip_address',request()->ip())
                         ->where('order_id',NULL)
                         ->get();
        }else{
            $carts = Cart::where('ip_address', request()->ip())
                         ->where('order_id',NULL)
                         ->get();
        }
        return $carts;  // return total cart 
    }

    public static function totalItems(){
        # if user is authenticated
       $carts = Cart::totalCart();
        $total_item = 0;
        foreach($carts as $cart){
            $total_item += $cart->product_quantity;
        }
        return $total_item;  // return total no of items that added by a user
    }
    
}
