	<div class="row">      			
          				@foreach($products as $product)          				
          				<div class="col-md-3">
							<div class="card">								
						{{--  <img class="card-img-top" src="{{asset('images/products/'.'Galaxy_A8.jpg')}}" alt="Card image"> --}}
						     	@php $i = 1; @endphp          				        
								@foreach($product->images as $image)
								@if ($i>0)
								<a href="{{ route('product.slug', $product->slug) }}">
								<img class="card-img-top" src="{{ asset('images/products/'. $image->image)}}" width="200" height="170"  alt="{{ $product->title }}"> 
							    </a>
								@endif									
								@php $i--; @endphp
								@endforeach                                
							  <div class="card-body">
							    <a href="{{ route('product.slug',$product->slug) }}">
							    	<b class="card-title text-small">{{ $product->title }}</b>
							    </a>
							    <p class="card-text">Price - {{ $product->price }}</p>
								
                                  @include('Frontend.pages.product.partials.cart-button')
							  </div>
							</div>          					
          				</div>
                       	@endforeach
					 </div>

{{-- pagination starts --}}					 			
<div class="mt-4 pagination">
	{{$products->links()}}
</div>