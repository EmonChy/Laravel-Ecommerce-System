@extends('Frontend.layouts.master')

@section('content')
<!--Start sidebar +  content -->
          <div class="row margin-top-20">
          	<div class="col-md-3">
                     <h3>Categories</h3>

                     @include('Frontend.partials.product_sidebar')
          	</div>
          	<div class="col-md-9">
          		<div class="widget">
          			<h3>All Products in <span class="badge badge-primary">{{ $category->name }} category</span></h3>

                @php
                  $products = $category->products()->paginate(4);
                @endphp

                @if($products->count() > 0)
                  {{-- true expr --}}
                     @include('Frontend.pages.product.partials.all_products') 
       
                @else
                  {{-- false expr --}}
                  <div class="alert alert-warning">
                    No Products has added yet in this category!!
                  </div>

                @endif

              </div>  
          		<div class="widget">
          		</div>
          	</div>
          </div>

	    <!--End sidebar +  content -->


@endsection('')