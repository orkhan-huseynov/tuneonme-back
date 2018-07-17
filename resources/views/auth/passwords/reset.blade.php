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
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
		{{ csrf_field() }}
		
		<input type="hidden" name="token" value="{{ $token }}">
		
		<div class="container-fluid container_form wrapper_container">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input type="text" placeholder="Email" name="email" class="form-control" value="{{ $email or old('email') }}" required autofocus />
						
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
					<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						<input type="password" placeholder="Password" name="password_confirmation" class="form-control" required />
						
						@if ($errors->has('password_confirmation'))
							<span class="help-block">
								<strong>{{ $errors->first('password_confirmation') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 container_form__submit_btn">
					<input type="submit" name="submit" value="Reset Password" class="btn btn-success"/>
					<a class="btn btn-link" href="{{ url('/login') }}">
						Already Remembered?
					</a>
				</div>
			</div>
		</div>
	</form>
</section>
@endsection
