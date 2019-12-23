@extends('Frontend.layouts.master')

@section('content')
<div class="container margin-top-20">

<h2>My Cart Items</h2>
@if (App\Models\Cart::totalItems() > 0)
    <table class="table table-hover table-stripe">
          <tr class="">
            <th>No</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Quantity</th>
            <th>Unit Price</th>
            <th>Sub total price</th>
            <th>Action</th>
          </tr>
          @php
              $total_amount = 0;
          @endphp
          {{--show total products that added to the cart by a user --}} 
          @foreach (App\Models\Cart::totalCart() as $cart)
              
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
            <td colspan=4></td>
            <td>Total Amount </td> 
            <td colspan=2><strong>{{ $total_amount }} Tk </strong></td>
        </tr>
        

</table>
<div class="float-right">
    <a href="{{ route('products') }}" class="btn btn-info btn-lg">Continue Shopping..</a>
    <a href="{{ route('checkouts') }}" class="btn btn-warning btn-lg">Checkout</a>
</div>
@else
    <div class="alert alert-warning">
    <strong>There is no item in the cart</strong>
    <br>
    <a href="{{ route('products') }}" class="btn btn-info btn-lg">Continue Shopping..</a>

    </div>
@endif
</div>
@endsection('')