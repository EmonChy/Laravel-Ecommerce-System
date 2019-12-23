@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header">Add Product</div>
        <div class="card-body">

          @include('Backend.partials.message') <!-- show error messages -->

          <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
             @csrf  <!-- used only in post method -->
             
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
  </div>
    <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" name="price" id="price" placeholder="Enter price">
  </div>
  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity">
  </div>

   <div class="form-group">
    <label for="quantity">Select Category</label>
    <select name="category_id" class="form-control">
      <option value="">Please select a category for product</option>
         {{-- parent category --}}
        @foreach (App\Models\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $parent)
        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
         {{-- sub category under parent --}}
                 @foreach (App\Models\Category::orderBy('name','asc')->where('parent_id',$parent->id)->get() as $child)
                 <option value="{{ $child->id }}">---->{{ $child->name }}</option> 
                 @endforeach 
        @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="quantity">Select Brand</label>
    <select name="brand_id" class="form-control">
      <option value="">Please select a brand for product</option>
      
        @foreach (App\Models\Brand::orderBy('name','asc')->get() as $brand)
          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
        @endforeach
    </select>
  </div>


    <div class="form-group">
    <label for="product_image">Image</label>
    <div class="row">
      <div class="col-md-4">
        <input type="file" class="form-control" name="product_image[]" id="product_image">
      </div>
      <div class="col-md-4">
        <input type="file" class="form-control" name="product_image[]" id="product_image">
      </div>
      <div class="col-md-4">
        <input type="file" class="form-control" name="product_image[]" id="product_image">
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Add Product</button>
</form>
        </div> 
        </div>            
          </div>
      </div>

@endsection      
