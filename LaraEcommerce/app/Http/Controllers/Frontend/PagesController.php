<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;


class PagesController extends Controller
{
        
    // display user homepage
    public function index(){
    	$sliders = Slider::orderBy('priority','ASC')->get();
    	$products = Product::orderBy('id','DESC')->paginate(4);
        return view('Frontend.pages.index', compact('products','sliders'));
       
    }
    // display contact page
    public function contact() {

        return view('Frontend.pages.contact');
        
   }

   // Product search by a user 
   public function search(Request $request)
   {
   	    # code...
        $search = $request->search;   

   	    $products = Product::orWhere('title','like','%'.$search.'%')
		                    ->orWhere('description','like','%'.$search.'%')
		                    ->orWhere('slug','like','%'.$search.'%')
		                    ->orWhere('price','like','%'.$search.'%')
		                    ->orWhere('quantity','like','%'.$search.'%')
		                    ->orderBy('id','desc')
		   	                ->paginate(4);

        return view('Frontend.pages.product.search',compact('search','products'));
   }

}
