<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;      // add product model
use App\Models\ProductImage; // add productImage model
use Image;     // use image class, third party package

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
	
   /* display all products  */
    public function index()
    {
        $products = Product::orderBy('id','DESC')->get(); // returns multiple row from a tbl
        return view('Backend.pages.product.index')->with('products',$products);
   
    }

   /* display product insert form  */
    public function create()
    {
    	return view('Backend.pages.product.create');
    }
   
   /* display product edit form by their respective id  */

    public function edit($id)
    {
        $product = Product::find($id);  // returns single row from a table by their respective id
        
        return view('Backend.pages.product.edit')->with('product',$product);
   
    }

     /* product insert into db  */
    public function store(Request $request)
    {
     	# code...
        // server side validation
     	$request->validate([
		    'title'      => 'required|max:150',
		    'description'=> 'required',
		    'price'      => 'required|numeric',
		    'quantity'   => 'required|numeric',
            'category_id'=> 'required',
            'brand_id'   => 'required',            
		]);

    	$product = new Product;  // product model 

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = str_slug($request->title);
        $product->category_id = $request->category_id;

        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;

        $product->save(); // data saved into db

        // image insert via ProductImage Model

       /*
       // single image insert

        if($request->hasFile('product_image')){

        	$image = $request->file('product_image');
        	$img = time().'.'.$image->getClientOriginalExtension();

            $location = public_path('images/products/'.$img);
            Image::make($image)->save($location);  // image file saved in directory

            $product_image=new ProductImage; // ProductImage Model
            $product_image->product_id = $product->id;
            $product_image->image=$img;

            $product_image->save();  // data saved into db 

            
        }
        */

        // multiple product image insert
        
         if(count($request->product_image)>0){
            $i = 0;
         	foreach ($request->product_image as $image) {
         		# code...
        	$img = time(). $i .'.'.$image->getClientOriginalExtension();  // image file extension

            $location = 'images/products/'.$img; // file store in this location
            Image::make($image)->save($location); // image file saved in directory

            $product_image= new ProductImage; // ProductImage Model
            $product_image->product_id = $product->id;
            $product_image->image=$img;

            $product_image->save(); // data saved into db
            $i++;
         	}
         }        
         session()->flash('success','Product has added successfully'); 
         return redirect()->route('admin.products');
  

    }

    /* update product data by their respective id  */

    public function update(Request $request,$id)
    {
    	# update product

    	# code...
        // server side validation
     	$request->validate([
		    'title'      => 'required|max:150',
		    'description'=> 'required',
		    'price'      => 'required|numeric',
		    'quantity'   => 'required|numeric',
            'category_id'=> 'required',
            'brand_id'   => 'required',
		]);

    	$product = Product::find($id); // update it by their id

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;

        $product->brand_id = $request->brand_id;
        $product->save(); // updated data saved into db          
        return redirect()->route('admin.products');
  
    }

    /* delete product by using their id  */

    public function delete($id)
    {
        # code...        
        $product = Product::find($id); // get specific id
        if(!is_null($product)){
            $product->delete(); // product delete method
        }
        // delete multiple images
        foreach($product->images as $img){
            // delete from folder
            $file_name = $img->image;
            if(file_exists("images/products/".$file_name)){
                unlink("images/products/".$file_name); // images delete from folder
            }
            $img->delete(); // delete from db
        }
        session()->flash('success','Product has deleted successfully !!');
        return back(); // after delete return in same page

    }
}

// php artisan config:cache   --- clearing cash
// php artisan view:clear     --- rest of the commands are also same      
// composer dump-autoload