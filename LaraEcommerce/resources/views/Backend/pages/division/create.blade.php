@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header"><span class="text-success" style="font-weight:bold">Add Division</span></div>
        <div class="card-body">
          @include('Backend.partials.message')
          <form action=" {{ route('admin.division.store') }}" method="post" enctype="multipart/form-data">
             @csrf
      
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Priority</label>
    <input type="text" class="form-control" name="priority" id="priority" placeholder="Enter priority">
  </div>

  <button type="submit" class="btn btn-primary">Add Division</button>
</form>
        </div> 
        </div>            
          </div>
      </div>

@endsection      
