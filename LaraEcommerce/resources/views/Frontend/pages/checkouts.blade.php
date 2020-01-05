@extends('Frontend.layouts.master')

@section('content')
<div class="container margin-top-20">

    <div class="card card-body">
    <h2>Confirm Items</h2>
    <hr>                    
        <div class="row">
            <div class="col-md-7 border-right">
            @foreach (App\Models\Cart::totalCart() as $cart)
            <p>
                {{ $cart->product->title }} -
                <strong>{{ $cart->product->price }} Tk</strong>
                - {{ $cart->product_quantity }} item
            </p>
             @endforeach
            </div>
            <div class="col-md-5">
               @php
                   $total_price = 0;
               @endphp
               @foreach (App\Models\Cart::totalCart() as $cart)
               @php
                   $total_price += $cart->product->price * $cart->product_quantity;
               @endphp                   
               @endforeach
               <p>Total Price : <strong>{{ $total_price }}</strong> Tk</p>                
               <p>Total Price with Shipping cost: <strong>{{ $total_price + App\Models\Setting::first()->shipping_cost  }}</strong> Tk</p>
            </div>
        </div>
        <p>
            <a href="{{ route('carts') }}">Change cart items</a>
        </p>


    </div>


    <div class="card card-body mt-2">
    <h2>Shipping Address</h2>
    <hr>                    
        <form method="POST" action="{{ route('checkouts.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->first_name.' '.Auth::user()->last_name : '' }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  Auth::check() ? Auth::user()->email : '' }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone no') }}</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{  Auth::check() ? Auth::user()->phone_no : '' }}" required autocomplete="phone_no">

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">Additional Message (Optional)</label>

                            <div class="col-md-6">
                                <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows=4></textarea>

                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_address" class="col-md-4 col-form-label text-md-right">Shipping Address*</label>

                            <div class="col-md-6">
                                <textarea id="street_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" rows=4 required>{{  Auth::check() ? Auth::user()->shipping_address : ''  }}</textarea>

                                @error('street_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_id" class="col-md-4 col-form-label text-md-right">Payment Type*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="payment_id" required id="payments">
                                    <option value="">Please select a payment method</option>
                                        @foreach ($payments as $payment)
                                        {{-- all payments type --}}
                                    <option value="{{$payment->short_name}}">{{ $payment->name }}</option>
                                        @endforeach
                                </select>

                                {{-- jquery effects start from here --}} 

                                @foreach ($payments as $payment)
                                    
                                        @if ($payment->short_name == "cash_in")
                                        <div id="payment_{{$payment->short_name }}" class="alert alert-success mt-2 hidden">
                                            <h3>
                                                For Cash in there is nothing necessary.Just click finish order.
                                            </h3>
                                            <p>
                                                You will get your product in two or three business days
                                            </p>
                                        </div>
                                        @else
                                        <div id="payment_{{$payment->short_name }}" class="alert alert-success text-center mt-2 hidden">
                                            <h3>
                                                {{$payment->name}} Payment
                                            </h3>
                                            <p>
                                                <strong>
                                                {{$payment->name}} No : {{$payment->no}}
                                                </strong>
                                                <br>
                                                <strong>
                                                Account Type : {{$payment->type}}
                                                </strong>
                                            </p>
                                            <div class="alert alert-success">
                                                Please send the above money to this Bkash no and write your transaction code here..
                                            </div>

                                         </div>
                                        @endif                                      
                                    
                                @endforeach
                                    <input type="text" class="form-control hidden" name="transaction_id" id="transaction_id" placeholder="Enter transaction code">

                             {{-- jquery effects ends --}}    
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Order Now') }}
                                    
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
    
</div>
@endsection('')

@section('scripts')
 <script type="text/javascript">
    $("#payments").change(function(){
        $payment_method = $("#payments").val(); // store payment type

        if($payment_method == "cash_in"){
            $("#payment_cash_in").removeClass('hidden');
            // rest of the types will be hidden
            $("#payment_bkash").addClass('hidden');
            $("#payment_rocket").addClass('hidden');

        }else if($payment_method == "bkash"){
            $("#payment_bkash").removeClass('hidden');
            // rest of the types will be hidden
            $("#payment_cash_in").addClass('hidden');
            $("#payment_rocket").addClass('hidden');
            // show transaction field
            $("#transaction_id").removeClass('hidden');

        }else if($payment_method == "rocket"){
            $("#payment_rocket").removeClass('hidden');
            // show transaction field
            $("#transaction_id").removeClass('hidden');
            // rest of the types will be hidden
            $("#payment_cash_in").addClass('hidden');
            // 
            $("#payment_bkash").addClass('hidden');
        }

    })
</script>   
@endsection