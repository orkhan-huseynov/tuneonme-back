@extends('layouts.app')

@section('content')
<section class="section_top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="section_top__heading_main">Tune On Me</h1>
				<h3 class="section_top__heading_sub">Be on the same wavelength</h3>
			</div>
		</div>
	</div>
</section>
<section class="section_form">
	<form name="form_sign_up" role="form" action="{{ url('/register') }}" method="POST">
		{{ csrf_field() }}
		<div class="container-fluid container_form wrapper_container">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<input type="text" placeholder="Name" name="name" class="form-control" value="{{ old('name') }}" required autofocus />
						
						@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
						<input type="text" placeholder="Last Name" name="lastname" class="form-control" value="{{ old('lastname') }}" required />
						
						@if ($errors->has('lastname'))
							<span class="help-block">
								<strong>{{ $errors->first('lastname') }}</strong>
							</span>
						@endif
					</div>
				</div>   
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input type="text" placeholder="Email" name="email" class="form-control" value="{{ old('email') }}" required />
						
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<input type="password" placeholder="Password" name="password" class="form-control" required />
						
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<input type="password" placeholder="Confirm Password" name="password_confirmation" class="form-control" required />						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 container_form__submit_btn">
					<input type="submit" name="submit" value="Sign Up" class="btn btn-success"/>
					<a class="btn btn-link" href="{{ url('/login') }}">
						Already Registered?
					</a>
				</div>
			</div>
		</div>
	</form>
</section>
@endsection
