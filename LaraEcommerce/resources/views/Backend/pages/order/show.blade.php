@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header">View Order #LE{{ $order->id}}</div>
        <div class="card-body">

           @include('Backend.partials.message')  {{-- display message --}}
            <h3>Order Informations</h3>
               <div class="row">
                    <div class="col-md-6 border-right">
                        <p><strong>Orderer Name : </strong>{{ $order->name }}</p>
                        <p><strong>Orderer Phone : </strong>{{ $order->phone_no }}</p>
                        <p><strong>Orderer Email : </strong>{{ $order->email }}</p>
                        <p><strong>Orderer Shipping Address : </strong>{{ $order->shipping_address }}</p>
                    </div>
                    <div class="col-md-6">

                        <p><strong>Order Payment Method : </strong>{{ $order->payment->name }}</p>
                        <p><strong>Order Payment Transaction : </strong>{{ $order->transaction_id }}</p>
                    
                    </div>
               </div>
               <hr>
               <h3>Ordered Items : </h3>

               {{-- relation occured between order and carts --}}
             
               @if ($order->carts->count() > 0)
                    <table class="table table-hover table-stripe">
                            <tr class="">
                            <th>No</th>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>T Qty</th>
                            <th>Product Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub total price</th>
                            <th>Action</th>
                            </tr>
                            @php
                                $total_amount = 0;
                            @endphp
                            {{--show total products that added to the cart by a user --}} 
                            @foreach ($order->carts as $cart)
                                
                            <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('product.slug',$cart->product->slug)}}">{{ $cart->product->title }}</a></td>
                            <td>
                            {{-- show only one image of product --}}               
                            @if($cart->product->images->count() > 0)
                                <img class="img-thumbnail" src="{{ asset('images/products/'. $cart->product->images->first()->image) }}" width="100" height="60"  alt="{{ $cart->product->title }}">                 
                            @endif
                            </td>
                            <td>
                                {{$cart->product->quantity}}
                            </td>
                            <td>
                            <form class="form-inline" action="{{ route('carts.update', $cart->id) }}" method="post">
                                @csrf
                                <input type="number" name="product_quantity" class="form-control" value="{{ $cart->product_quantity }}"/>
                                <button type="submit" class="btn btn-outline-success ml-1">Update</button>
                            </form>
                            </td>
                            <td>
                                {{-- unit price of each product --}} 
                                {{ $cart->product->price }} Tk
                            </td>
                            <td>
                                @php
                                    // sum total amount of each product 
                                    $total_amount += $cart->product->price * $cart->product_quantity;    
                                @endphp
                                    {{-- sub total price --}}  
                                {{ $cart->product->price * $cart->product_quantity }} Tk
                            </td>
                            <td>
                            <form class="form-inline" action="{{ route('carts.destroy', $cart->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="cart_id" class="form-control"/> 
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                            </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan=5></td>
                            <td>Total Amount </td> 
                            <td colspan=2><strong>{{ $total_amount }} Tk </strong></td>
                        </tr>
                        

                    </table>
                @endif
                <hr>
                    <form action = "{{ route('admin.order.charge',$order->id) }}" method="post">
                    @csrf
                        <label for="">Shipping Charge : </label>
                        <input class="form-control" type="number" name="shipping_charge" id="shipping_charge" value="{{ $order->shipping_charge }}">
                        <br>
                        <label for="">Customer Discount : </label>
                        <input class="form-control" type="number" name="customer_discount" id="customer_discount" value="{{ $order->customer_discount }}">                        
                        <br>
                        <input type="submit" value="Update" class="btn btn-primary">
                        <a href="{{ route('admin.order.invoice',$order->id)}}" class="ml-2 btn btn-info">Generate Invoice</a>
                    </form>
                <hr>
                
                <form action = "{{ route('admin.order.completed',$order->id) }}" method="post" style="display: inline-block!important;">
                    @csrf
                    @if ($order->is_completed)
                        <input type="submit" value="Cancel Order" class="btn btn-success">
                    @else
                        <input type="submit" value="Complete Order" class="btn btn-info">                        
                    @endif
                </form>

                <form action = "{{ route('admin.order.paid',$order->id) }}" method="post" style="display: inline-block!important;">
                    @csrf
                    @if ($order->is_paid)
                        <input type="submit" value="Cancel Payment" class="btn btn-success">
                    @else
                        <input type="submit" value="Paid Order" class="btn btn-info">                        
                    @endif
                </form>

        </div> 
        </div>            
          </div>
      </div>

@endsection      
