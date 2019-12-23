<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

use Image;
use File;

class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$brands = Brand::orderBy('id','desc')->get();
    	return view('Backend.pages.brand.index',compact('brands'));
    }

    public function create()
    {
    	# code...
    	return view('Backend.pages.brand.create');
   
    }
    // brand insert to db
    public function store(Request $request)
    {
    	# code...
        $this->validate($request,[
           'name'=>'required',
           'image'=>'nullable|image',
    	],
    	[
           'name.required' =>'Please provide a brand name',
           'image.image' =>'Please provide a valid image with .jpg, .png, .jpeg, .gif extension..',

    	]);

    	$brand = new Brand();

    	$brand->name = $request->name;
    	$brand->description = $request->description;

    	// image insert for brand

        if($request->hasFile('image')){
        	// insert that image
        	$image = $request->file('image');
        	$img = time().'.'.$image->getClientOriginalExtension();

            $location = 'images/brands/'.$img;
            Image::make($image)->save($location);

            $brand->image=$img;
          }
            $brand->save(); 

            session()->flash('success','A new brand has added successfully');
            return redirect()->route('admin.brands');
    }

    public function edit($id)
    {    	
    	# code...    
    	$brand = Brand::find($id);
    	if(!is_null($brand)){
    	return view('Backend.pages.brand.edit',compact('brand'));
        }else{
        	return direct()->route('admin.brands');
        }
    }


     //  updated brand insert to db
    public function update(Request $request,$id)
    {
    	# code...
        $this->validate($request,[
           'name'=>'required',
           'image'=>'nullable|image',
    	],
    	[
           'name.required' =>'Please provide a brand name',
           'image.image' =>'Please provide a valid image with .jpg, .png, .jpeg, .gif extension..',

    	]);

    	$brand = Brand::find($id);

    	$brand->name = $request->name;
    	$brand->description = $request->description;
    	//update image insert

        if($request->hasFile('image')){
        	// delete the old image from folder
            if(File::exists('images/brands/'.$brand->image)){
            	File::delete('images/brands/'.$brand->image);
            }

        	$image = $request->file('image');
        	$img = time().'.'.$image->getClientOriginalExtension();

            $location = 'images/brands/'.$img;
            Image::make($image)->save($location);

            $brand->image=$img;
          }
            $brand->save(); 

            session()->flash('success','Brand has updated successfully');
            return redirect()->route('admin.brands');
    }


     public function delete($id)
    {
        # code...
        
        $brand = Brand::find($id);
        if(!is_null($brand)){
            
            // delete the brand image
        	if(File::exists('images/brands/'.$brand->image)){
            	File::delete('images/brands/'.$brand->image);
            }
            $brand->delete();
        }
        session()->flash('success','Brand has deleted successfully !!');
        return back();

    }


}
