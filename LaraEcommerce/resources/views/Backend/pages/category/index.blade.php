@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header">Manage Category</div>
        <div class="card-body">

           @include('Backend.partials.message')  {{-- display message --}}

        <table class="table table-hover table-striped">
          <tr class="text-center">
            <th>#</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Parent Category</th>
            <th>Action</>
          </tr>

           @foreach ($categories as $category)          
             <tr class="text-center">
               <td>{{$loop->iteration}}</td>
               <td>{{$category->name }}</td>
               <td>                                  
                 <img src="{{ asset('images/categories/'.$category->image) }}" width="100">  
               </td>

               <td>
                 @if($category->parent_id==NULL)
                    Primary Category
                 @else
                   {{ $category->parent->name }}
                  {{-- print sub category under parent category --}}
                 @endif
               </td>
               <td>
                <a href="{{ route('admin.category.edit',$category->id )}}" class="btn btn-outline-info">Edit</a>
                <a href="#deleteModal{{$category->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>


                <!-- Modal starts -->
                <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('admin.category.delete',$category->id) }}" method="post">
                         @csrf
                         <button type="submit" class="btn btn-outline-danger">Permanent Delete</button>                
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>                       
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal ends -->
               </td>
             </tr>
          

           @endforeach
           
          
        </table>
       
        </div> 
        </div>            
          </div>
      </div>

@endsection      
