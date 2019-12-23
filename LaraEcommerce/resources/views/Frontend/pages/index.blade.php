@extends('Frontend.layouts.master')

@section('content')
{{-- Carousel Slider Starts--}}

	<div class="our-slider">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
			  @foreach ($sliders as $slider)
				<li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>			
			  @endforeach	
			</ol>
			  <div class="carousel-inner">
			  @foreach ($sliders as $slider)
				<div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
				<img class="d-block w-100" src="{{ asset('images/sliders/'.$slider->image) }}" alt="{{ $slider->title }}" style="height:450px">				
					<div class="carousel-caption d-none d-md-block">
						<h5>{{ $slider->title }}</h5>
							<p>
							<!--
							@if ($slider->button_text)
							  <a href="{{ $slider->button_link }}" target="_blank" class="btn btn-danger">{{ $slider->button_text}}</a>		
							@endif
							-->	
							</p>				
					</div>
				</div>
				@endforeach
  			 </div>

			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			</div>
	</div>
	{{-- Carousel Slider Ends--}}

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
