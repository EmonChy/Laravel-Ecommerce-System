@extends('Frontend.layouts.master')
@section('title')
  {{--dynamic title--}}
     {{ $product->title }} | Laravel Ecommerce Site
@endsection														
@section('content')
<!--Start sidebar +  content -->
          <div class="row margin-top-20">
          	<div class="col-md-3"> 

           <div id="carouselExampleControls"  class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               
                @php  $i=1; @endphp
                @foreach($product->images as $image)
                     {{-- expr --}}               
                   <div class="carousel-item {{ $i==1 ? 'active':'' }}">
                    
                     <img class="d-block w-100" src="{{ asset('images/products/'.$image->image) }}" alt="First slide">
                  
                   </div>

                @php $i++; @endphp
                @endforeach
                 </div>
                 <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                   <span class="sr-only">Previous</span>
                 </a>
                 <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                   <span class="sr-only">Next</span>
                 </a>
               </div>

               <div class="mt-3">
                 <p>Category : <span class="badge badge-info">{{ $product->category->name }}</span></p>
                 <p>Brand : <span class="badge badge-info">{{ $product->brand->name }}</span></p>

               </div>

          	</div>
          	<div class="col-md-9">
          		<div class="widget">
                      <h3>{{ $product->title }}</h3> 
                      <h3>Price : {{ $product->price }} Tk 
                         <span class="badge badge-primary">
                            {{ $product->quantity<1 ? 'No Item is available' : $product->quantity.' item in stock' }} 

                         </span> </h3> 
                         <hr>
                         <div class="product-descriptipon">
                              {{ $product->description }}
                         </div>      			
          		</div>
          		<div class="widget">
          		</div>
          	</div>
          </div>
	    <!--End sidebar +  content -->
@endsection('')
