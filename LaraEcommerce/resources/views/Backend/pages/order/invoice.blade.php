<html>
    <head>
        <title>Invoice - {{ $order->id}}</title>
        <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
        <style>
        .content-wrapper{
            background : #FFF;
        }
        .invoice-header{
            background: #f7f7f7;
            padding: 10px 20px 10px 20px;
            border-bottom: 1px solid gray;
        }
        .invoice-right-top h3{
            padding-right: 20px;
            margin-top: 20px;
            color: #ec5d01;
            font-size: 55px!important;
            font-family: serif;
        }
        .invoice-left-top{
            border-left: 4px solid #ec5d00;
            padding-left: 20px;
            padding-top: 20px;
        }
        thead{
            background: #ec5d01;
            color: #FFF;
        }
        .authority h5{
            margin-top : -10px;
            color: #ec5d01;

        }
        .thanks h4{
            color: #ec5d01;
            font-size: 25px;
            font-weight: normal; 
            font-family: serif;
            margin-top: 20px;
        }
        .site-logo{
            padding-top:10px;
        }
        .site-address p{
            line-height: 6px;
            font-weight: 300;
        }
        </style>
    </head>
    <body>
        <div class="content-wrapper">
        <div class="invoice-header">
            <div class="float-left site-logo">
            <img src="{{ asset('images/favicon.png')}}" alt="">
        </div>
        <div class="float-right site-address">
            <h4>Lara Ecommerce</h4>
            <p>Chittagong,Bangladesh</p>
            <p>Phone <a href="">01812086003</a></p>
            <p>Email <a href="mailTo:LaraEcommerce@gmail.com">LaraEcommerce@gmail.com</a></p>
        </div>
        <div class="clearfix"></div>
        </div>

        <div class="invoice-description">
            <div class="invoice-left-top float-left">
                <h6>Invoice To</h6>
                <h3>{{ $order->name }}</h3>
                <div class="address">
                    <p>
                        <strong>Address : </strong>
                        {{$order->shipping_address}}
                    </p>
                    <p>Phone : {{$order->phone_no}}</p>
                    <p>Email : <a href="mailTo:{{$order->email}}">{{$order->email}}</a></p>
                </div>
            </div>
            <div class="invoice-right-top float-right">
                <h3>Invoice #{{$order->id}}</h3>
                <p>
                    {{$order->created_at}}                
                </p>
            </div>
            <div class="clearfix"></div>
        </div>

            <h3>Products</h3>
               {{-- relation occured between order and carts --}}
             
               @if ($order->carts->count() > 0)
                    <table class="table table-hover table-stripe">
                    <thead>
                        <tr class="">
                            <th>No</th>
                            <th>Product Title</th>
                            <th>Product Quantity</th>
                            <th>Unit Price</th>
                            <th>Sub total price</th>
                            </tr>
                    </thead>
                    <tbody>
                            @php
                                $total_amount = 0;
                            @endphp
                            {{--show total products that added to the cart by a user --}} 
                            @foreach ($order->carts as $cart)                                
                            <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('product.slug',$cart->product->slug)}}">{{ $cart->product->title }}</a></td>
                            <td>
                                {{ $cart->product_quantity }}
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
                            </tr>
                        @endforeach
                    </tbody>                    
                    <tfoot>
                        <tr>
                            <td colspan=3></td>
                            <td>Discount </td> 
                            <td colspan=2><strong>{{ $order->customer_discount }} Tk </strong></td>
                        </tr>
                        <tr>
                            <td colspan=3></td>
                            <td>Shipping Charge </td> 
                            <td colspan=2><strong>{{ $order->shipping_charge }} Tk </strong></td>
                        </tr>
                        <tr>
                            <td colspan=3></td>
                            <td>Total Amount </td> 
                            <td colspan=2><strong>{{ $total_amount + $order->shipping_charge - $order->customer_discount }} Tk </strong></td>
                        </tr>
                        
                    </tfoot>        
                        
                    </table>
                @endif   
                <div class="thanks mt-3">
                    <h4>Thanks For Your Business</h4>
                </div> 
                <div class="authority float-right mt-5">
                    <p>------------------------------</p>
                    <h5>Authority Signature: </h5>
                </div>
                 <div class="clearfix"></div>      
          </div>     
    </body>
</html>