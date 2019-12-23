@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header"><span class="text-success" style="font-weight:bold">Add District</span></div>
        <div class="card-body">
          @include('Backend.partials.message')
          <form action=" {{ route('admin.district.store') }}" method="post" enctype="multipart/form-data">
             @csrf
      
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Select a division for this district</label>
    <select class="form-control" name="division_id">
      <option value="">Please select a division</option>
      @foreach ($divisions as $division)
        {{-- all divisions --}}
      <option value="{{$division->id}}">{{ $division->name }}</option>
         @endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Add District</button>
</form>
        </div> 
        </div>            
          </div>
      </div>

@endsection      
