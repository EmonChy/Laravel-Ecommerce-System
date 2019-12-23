@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header">Manage Orders</div>
        <div class="card-body">

           @include('Backend.partials.message')  {{-- display message --}}

        <table class="table table-hover table-striped" id="datatable">
          <thead>
            <tr class="text-center">
              <th>#</th>
              <th>Orderer ID</th>
              <th>Orderer Name</th>
              <th>Orderer Phone no</th>
              <th>Order Status</th>
              <th>Action</>
            </tr>
          </thead>
        <tbody>
        @foreach ($orders as $order)          
             <tr class="text-center">
               <td>{{$loop->iteration}}</td>
               <td>#LE{{ $order->id}}</td>
               <td>{{ $order->name }}</td>
               <td>{{ $order->phone_no}}</td>

               <td>
                  <p>
                      @if ($order->is_seen_by_admin)
                          <span class="badge badge-success">Seen</span>
                      @else
                          <span class="badge badge-warning">Unseen</span>
                          
                      @endif
                  </p>
                  <p>
                      @if ($order->is_completed)
                          <span class="badge badge-success">Completed</span>
                      @else
                          <span class="badge badge-warning">Not Completed</span>
                      @endif
                  </p>
                  <p>
                      @if ($order->is_paid)
                          <span class="badge badge-success">Paid</span>
                      @else
                          <span class="badge badge-danger">Unpaid</span>
                      @endif
                  </p>
               </td>
               <td>

               <a href="{{ route('admin.order.show',$order->id) }}" class="btn btn-outline-info">View Order</a>

               <a href="#deleteModal{{$order->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>

                <!-- Modal starts -->
                <div class="modal fade" id="deleteModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('admin.order.delete',$order->id) }}" method="post">
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
