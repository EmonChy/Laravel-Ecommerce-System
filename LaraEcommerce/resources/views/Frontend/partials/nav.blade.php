<!-- Start navbar part -->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand text-white" href="{{ route('index') }}">
	  	<img src="{{ asset('images/e_logo.png')}}" alt="">
	  </a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item {{ Route:: is('index') ? 'active' : ''}}">
	        <a class="nav-link text-white" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item {{ Route:: is('products') ? 'active' : ''}}">
	        <a class="nav-link text-white" href="{{ route('products') }}">Products</a>
	      </li>
	      <li class="nav-item {{ Route:: is('contacts') ? 'active' : ''}}">
	        <a class="nav-link text-white" href="{{ route('contact') }}">Contact</a>
	      </li>
		  <li class="nav-item">
		  	    {{-- product search by a user --}}
	 <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="get">
	    <div class="input-group">
	    <input type="text" class="form-control" name="search" placeholder="Search Products" aria-label="Recipient's username" aria-describedby="button-addon2">
	    <div class="input-group-append">
	    <button class="btn btn-outline-secondary" type="button" id="button-addon2" 
						style="background-color: #FDD922;"><i class="fa fa-search"></i></button>
	    </div>
	   </div>	
	 </form>
	      </li>
	    </ul>
		<ul class="navbar-nav ml-auto">
		<li>
			<a class="nav-link" href="{{ route('carts')}}">
			<button class="btn btn-danger">
				<span class="mt-1">Cart</span>
				<span class="badge badge-warning" id="totalItems">
			   {{ App\Models\Cart::totalItems() }}
				</span>
			</button>
			</a>
		</li>
		<li class= "nav-item">
		  @guest
			<li class="nav-item">
				<a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
			</li>
			@if (Route::has('register'))
				<li class="nav-item">
					<a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
			@endif
		@else
			<li class="nav-item dropdown">
				<a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					<img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" class="img rounded-circle" alt="" style="width:35px" >
					{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
					<span class="caret"></span>
				</a>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('user.dashboard')}}">
					My dashboard
					</a>
					<a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
        @endguest
		</li>
        </ul>
	   	  </div>
	</nav>
	<!-- End navbar part -->