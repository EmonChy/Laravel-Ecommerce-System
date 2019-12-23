<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoriesController extends Controller
{
   
    public function show($id)
    {
        //
        $category=Category::find($id);

        if(!is_null($category)){

            return view('Frontend.pages.category.show', compact('category'));
        }else{
             session()->flash('errors' ,'Sorry !! there is no category by this id');
             return redirect()->route('products');
        }
    }

}
