{{-- show error message of input fields --}}
@if ($errors->any())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        </div>
    </div>
</div>    
@endif

{{-- msg show  --}}

@if (Session::has('success'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
	          <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                   
                  <p>{{ Session::get('success') }}</p>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
        </div>
    </div>
</div>
@endif


@if (Session::has('sticky_error'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
	          <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                   
                  <p>{{ Session::get('sticky_error') }}</p>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
        </div>
    </div>
</div>
@endif