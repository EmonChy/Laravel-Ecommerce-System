@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header">Edit Brand</div>
        <div class="card-body">
          @include('Backend.partials.message')
            <form action="{{ route('admin.brand.update',$brand->id) }}" method="post" enctype="multipart/form-data">
              @csrf
            
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $brand->name}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Description(optional)</label>
                <textarea name="description" rows="8" cols="80" class="form-control">{{ $brand->description}}</textarea>
              </div>

              <div class="form-group">
                <label for="oldimage">Old Image</label>
                <img src="{{ asset('images/brands/'.$brand->image) }}" width="100"><br>
                <label for="image">New Image(optional)</label>
                  <input type="file" class="form-control" name="image" id="image">
              </div>
              <button type="submit" class="btn btn-success">Update Brand</button>
</form>
        </div> 
        </div>            
          </div>
      </div>

@endsection      
