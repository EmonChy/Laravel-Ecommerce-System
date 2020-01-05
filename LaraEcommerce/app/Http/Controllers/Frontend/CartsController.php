<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;


use Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Frontend.pages.cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'product_id' => 'required'            
        ],
        [   
           'product_id.required' => 'Please give a product'

        ]);

        # if user is authenticated
        if(Auth::check()){
            $cart = Cart::where('user_id', Auth::id())
                        ->where('product_id',$request->product_id)
                        ->where('order_id',NULL)
                        ->first(); // single row
        }else{
            $cart = Cart::where('ip_address',request()->ip())
                        ->where('product_id',$request->product_id)
                        ->where('order_id',NULL)
                        ->first();
        }

        # if user already added a product into the cart 
        if(!is_null($cart)){
            $cart->increment('product_quantity');
            $cart->save();
        }
        # when user will first add a product 
        else{

            $cart = new Cart();
            $product = new Product();
            # if user exist
            if(Auth::check()){
                $cart->user_id = Auth::id();
            }
            $cart->ip_address = request()->ip();
            $cart->product_id = $request->product_id;
            $cart->save();
        }
        session()->flash('success','Product has added to cart');
        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // cart item update by a user 
    public function update(Request $request, $id)
    {
        // fetch card records by id
        $cart = Cart::find($id);
        if(!is_null($cart)){
           $cart->product_quantity = $request->product_quantity;
           $cart->save();

        }else{
            return redirect()->route('carts');
        }
        session()->flash('success','Cart item has updated successfully !!');
        return back();

    }
   // cart item delete by a user
    public function destroy($id){
        $cart = Cart::find($id);
        if(!is_null($cart)){
           $cart->delete();
        }else{
            return redirect()->route('carts');
        }
        session()->flash('success','Cart item has deleted !!');
        return back();
    }
}
