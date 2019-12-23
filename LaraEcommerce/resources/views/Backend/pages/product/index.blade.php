@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header">Manage Product</div>
        <div class="card-body">

           @include('Backend.partials.message')  {{-- display product delete message --}}

        <table class="table table-hover table-striped" id="datatable">
          <thead>
            <tr class="text-center">
            <th>#</th>
            <th>Product Code</th>
            <th>Product Title</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)           
             <tr class="text-center">
               <td>{{ $loop->iteration }}</td>
               <td>#PLE{{ $product->id }}</td>
               <td>{{ $product->title }}</td>
               <td>{{ $product->price }}</td>
               <td>{{ $product->quantity }}</td>
               <td>
                <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-outline-info">Edit</a>
                <a href="#deleteModal{{$product->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('admin.product.delete',$product->id) }}" method="post">
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
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6"></td>
            </tr>
          </tfoot>
          
        </table>
       
        </div> 
        </div>            
          </div>
      </div>

@endsection      
