@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header"><span class="text-success" style="font-weight:bold">Add Category</span></div>
        <div class="card-body">
          @include('Backend.partials.message')
          <form action=" {{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
             @csrf
      
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description (optional)</label>
    <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
  </div>

   <div class="form-group">
    <label for="exampleInputPassword1">Parent category (optional)</label>
    <select class="form-control" name="parent_id">
      <option value="">Please select category</option>
      @foreach ($main_categories as $category)
        {{-- expr --}}
      <option value="{{$category->id}}">{{ $category->name }}</option>
         @endforeach
    </select>
  </div>

    <div class="form-group">
    <label for="image">Image</label>
      <input type="file" class="form-control" name="image" id="image">
  </div>
  <button type="submit" class="btn btn-primary">Add Category</button>
</form>
        </div> 
        </div>            
          </div>
      </div>

@endsection      
