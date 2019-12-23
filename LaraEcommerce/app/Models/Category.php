<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 // 
 public $fillable = [
	'name',
	'description',
	'image',
	'parent_id',

];
	public function parent()
	{
		# code...
		# relationship to find out parent category   
		return $this->belongsTo(Category::class,'parent_id');
	}

      // one to many relationship
     public function products()
	{
		# code...
		return $this->hasMany(Product::class);
	}

/*
ParentOrNotCategory
check if the category is child category of parent category

 int parent_id
 int child_id

*/
    public static function ParentOrNotCategory($parent_id,$child_id)
    {
    	# code...

		$categories = Category::where('id',$child_id)->where('parent_id',$parent_id)->get();
		
        if(!is_null($categories)){
        	return true;
           }else{
        	return false;
        }
    }

}

