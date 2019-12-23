	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">	
		<title>
		   @yield('title','Laravel Ecommerce Project')
		</title>
		{{-- include style files --}}
         @include('Frontend.partials.styles')

	</head>
	<body>
		<div class="wrapper" style="background-color: whitesmoke;">
			<div class="container">
				<div class="row">
				   <div class="col-md-12">
					{{-- include navigation bar --}}
	                 @include('Frontend.partials.nav')
					 @include('Frontend.partials.message')
		             @yield('content')
				   </div>
					
				</div>
				    {{-- include footer --}}
					                             	
                   	@include('Frontend.partials.footer')
				                       
			</div>
		</div>
		         {{-- include all script files --}}
	         @include('Frontend.partials.scripts')

			 @yield('scripts')
  </body>
</html>
