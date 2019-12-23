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
          			<h3>All Products</h3>
          	         @include('Frontend.pages.product.partials.all_products')         			
          		</div>
          		<div class="widget">
          		</div>
          	</div>
          </div>
<!--End sidebar +  content -->
@endsection('')
