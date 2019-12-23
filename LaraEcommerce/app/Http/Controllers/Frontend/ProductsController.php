<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;


class ProductsController extends Controller
{
	// display products
	public function index() {
        // fetch all products from db 
   	    $products = Product::orderBy('id','DESC')->paginate(4);
        return view('Frontend.pages.product.index')->with('products',$products);
    }
    // single product search
    public function slug($slug)
    {
    	# code...
        // slug fetch from db
    	$product = Product::where('slug',$slug)->first(); // only one product show
    	if(!is_null($product)){
                return view('Frontend.pages.product.show',compact('product')); 
    	}else{
          session()->flash('errors','Sorry !! There is no product by this URL');
          return redirect()->route('admin.products');
    	}
    }
   
}