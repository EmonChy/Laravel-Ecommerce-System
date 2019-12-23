@extends('Frontend.pages.user.master')

@section('sub-content')
<div class="container">

<h2>Welcome {{ $user->first_name.' '.$user->last_name }}</h2>
<p>You can change your profiles and every informations here</p>
<hr>
<div class="row">
<div class="col-md-4">
<div class="card-body mt-2">
<a href="{{ route('user.profile')}}" class="btn btn-outline-success">Update Profile</a>
</div>
</div>
</div>

</div>
@endsection('')