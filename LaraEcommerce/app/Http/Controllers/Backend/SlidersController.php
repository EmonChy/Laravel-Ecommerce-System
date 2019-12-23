<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

use Image;
use File;

class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$sliders = Slider::orderBy('priority','asc')->get();
    	return view('Backend.pages.slider.index',compact('sliders'));
    }

    // slider insert to db
    public function store(Request $request)
    {
    	# code...
        $this->validate($request,[
           'title'=>'required',
           'image'=>'required|image',            
           'priority'=>'required',
           'button_link' =>'nullable|url'
    	],
    	[
           'title.required' =>'Please provide a valid title',
           'image.image' =>'Please provide a slider valid image',
           'image.required' =>'Please provide a slider image',
           'priority.required' =>'Please provide slider priority',

    	]);

    	$slider = new Slider();

        $slider->title = $request->title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;
        
        // image insert

        if($request->hasFile('image')){
            // insert that image
            $image = $request->file('image');
            $img = time().'.'.$image->getClientOriginalExtension();

            $location = 'images/sliders/'.$img;
            Image::make($image)->save($location);

            $slider->image=$img;
            }

        $slider->save(); 
            
        session()->flash('success','A new slider has added successfully');
        return redirect()->route('admin.sliders');
    }

     //  updated slider insert to db
    public function update(Request $request,$id)
    {
    	# code...
        $this->validate($request,[
            'title'=>'required',
            'image'=>'nullable|image',            
            'priority'=>'required',
            'button_link' =>'nullable|url'
         ],
         [
            'title.required' =>'Please provide a valid title',
            'image.image' =>'Please provide a slider valid image',
            'button_link.url' =>'Please provide a valid slider button link',
            'priority.required' =>'Please provide slider priority',
         ]);

    	$slider = Slider::find($id);

        $slider->title = $request->title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;

        //update image 

        if($request->hasFile('image')){

            // delete the old image from folder
            
            if(File::exists('images/sliders/'.$slider->image)){
                File::delete('images/sliders/'.$slider->image);
            }

            $image = $request->file('image');
            $img = time().'.'.$image->getClientOriginalExtension();

            $location = 'images/sliders/'.$img;
            Image::make($image)->save($location);

            $slider->image=$img;
            }
      
        $slider->save(); 
        
        session()->flash('success','Slider has updated successfully');
        return redirect()->route('admin.sliders');
    }

    // delete slider 
     public function delete($id)
    {
        # code...        
        $slider= Slider::find($id);
        if(!is_null($slider)){
            // delete the slider image
        	if(File::exists('images/sliders/'.$slider->image)){
            	File::delete('images/sliders/'.$slider->image);
            }
            $slider->delete();
        }
        session()->flash('success','Slider has deleted successfully !!');
        return back();

    }
}
