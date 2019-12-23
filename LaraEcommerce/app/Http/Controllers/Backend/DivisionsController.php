<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\District;

class DivisionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$divisions = Division::orderBy('priority','asc')->get();
    	return view('Backend.pages.division.index',compact('divisions'));
    }

    public function create()
    {
    	# code...
    	return view('Backend.pages.division.create');
   
    }
    // division insert to db
    public function store(Request $request)
    {
    	# code...
        $this->validate($request,[
           'name'=>'required',
           'priority'=>'required',
    	],
    	[
           'name.required' =>'Please provide a division name',
           'priority.required' =>'Please provide a division priority',

    	]);

    	$division = new Division();

    	$division->name = $request->name;
    	$division->priority = $request->priority;

        $division->save(); 
            
        session()->flash('success','A new division has added successfully');
        return redirect()->route('admin.divisions');
    }

    public function edit($id)
    {    	
    	# code...    
    	$division = Division::find($id);
    	if(!is_null($division)){
    	return view('Backend.pages.division.edit',compact('division'));
        }else{
        	return direct()->route('admin.divisions');
        }
    }


     //  updated division insert to db
    public function update(Request $request,$id)
    {
    	# code...
        $this->validate($request,[
            'name'=>'required',
            'priority'=>'required',
         ],
         [
            'name.required' =>'Please provide a division name',
            'priority.required' =>'Please provide a division priority',
 
         ]);
    	$division = Division::find($id);

    	$division->name = $request->name;
    	$division->priority = $request->priority;
        $division->save(); 
        
        session()->flash('success','Division has updated successfully');
        return redirect()->route('admin.divisions');
    }


     public function delete($id)
    {
        # code...        
        $division = Division::find($id);
        if(!is_null($division)){
            // delete all the districts under the division
            $districts = District::where('division_id',$division->id)->get();
            foreach($districts as $district){
                $district->delete();
            }
            $division->delete();
        }
        session()->flash('success','Division has deleted successfully !!');
        return back();

    }
}
