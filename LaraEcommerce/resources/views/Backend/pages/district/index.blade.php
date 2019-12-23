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
            <th>District Name</th>
            <th>Division Name</th>
            <th>Action</>
          </tr>

           @foreach ($districts as $district)          
             <tr class="text-center">
               <td>{{$loop->iteration}}</td>
               <td>{{$district->name }}</td>
               <td>{{$district->division->name }}</td>
               <td>
                <a href="{{ route('admin.district.edit',$district->id )}}" class="btn btn-outline-info">Edit</a>
                <a href="#deleteModal{{$district->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>


                <!-- Modal starts -->
                <div class="modal fade" id="deleteModal{{$district->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('admin.district.delete',$district->id) }}" method="post">
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
