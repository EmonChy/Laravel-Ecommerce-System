<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

use Image;
use File;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$categories = Category::orderBy('id','desc')->get();
    	return view('Backend.pages.category.index',compact('categories'));
    }

    public function create()
    {
        # code...
        # fetch all main categories
    	$main_categories = Category::orderBy('id','desc')->where('parent_id',Null)->get();
    	return view('Backend.pages.category.create',compact('main_categories'));
   
    }
    // category insert to db
    public function store(Request $request)
    {
        # code...
        # server side validation
        $this->validate($request,[
           'name'=>'required',
           'image'=>'required|nullable|image',
    	],
    	[
           'name.required' =>'Please provide a category name',
           'image.image' =>'Please provide a valid image with .jpg, .png, .jpeg, .gif extension..',

    	]);

    	$category = new Category();

    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->parent_id = $request->parent_id;

    	// image insert

        if($request->hasFile('image')){
        	// insert that image
        	$image = $request->file('image');
        	$img = time().'.'.$image->getClientOriginalExtension();

            $location = 'images/categories/'.$img;
            Image::make($image)->save($location);

            $category->image= $img;
          }
            $category->save(); 

            session()->flash('success','A new category has added successfully');
            return redirect()->route('admin.categories');
    }

    public function edit($id)
    {
    	# code...
        $main_categories = Category::orderBy('id','desc')->where('parent_id',Null)->get();
    
    	$category = Category::find($id);
    	if(!is_null($category)){
    	    return view('Backend.pages.category.edit',compact('category','main_categories'));
        }else{
        	return redirect()->route('admin.categories');
        }
    }

   //  updated category insert to db
    public function update(Request $request,$id)
    {
    	# code...
        $this->validate($request,[
           'name'=>'required',
           'image'=>'nullable|image',
    	],
    	[
           'name.required' =>'Please provide a category name',
           'image.image' =>'Please provide a valid image with .jpg, .png, .jpeg, .gif extension..',

    	]);

    	$category = Category::find($id);

    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->parent_id = $request->parent_id;

    	//update image 

        if($request->hasFile('image')){

            // delete the old image from folder
            
            if(File::exists('images/categories/'.$category->image)){
            	File::delete('images/categories/'.$category->image);
            }

        	$image = $request->file('image');
        	$img = time().'.'.$image->getClientOriginalExtension();

            $location = 'images/categories/'.$img;
            Image::make($image)->save($location);

            $category->image=$img;
          }
            $category->save(); 

            session()->flash('success','Category has updated successfully');
            return redirect()->route('admin.categories');
    }


     public function delete($id)
    {
        # code...
        
        $category = Category::find($id);
        if(!is_null($category)){

            // if it is parent category,then delete all its sub category
            if($category->parent_id == NUll){
              // delete sub categories
              $sub_categories = Category::orderBy('id','desc')->where('parent_id',$category->id)->get();
              foreach ($sub_categories as $sub) {
              	# delete sub images from folder
              	if(File::exists('images/categories/'.$sub->image)){
            	    File::delete('images/categories/'.$sub->image);
                  }
                $sub->delete(); // delete
              }
            }
            
            // delete the category image
        	if(File::exists('images/categories/'.$category->image)){
            	File::delete('images/categories/'.$category->image);
            }
            $category->delete();
        }
        session()->flash('success','Category has deleted successfully !!');
        return back();

    }


}
