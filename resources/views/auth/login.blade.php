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
	<form name="form_sign_up" action="{{ url('/login') }}" method="POST">
		{{ csrf_field() }}
		<div class="container-fluid container_form wrapper_container">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input type="text" placeholder="Email" name="email" class="form-control" value="{{old('email')}}" required autofocus />
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
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Remember Me
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 container_form__submit_btn">
					<input type="submit" name="submit" value="Log In" class="btn btn-success btn_submit"/>
					<a class="btn btn-link" href="{{ url('/password/reset') }}">
						Forgot Your Password?
					</a>
				</div>
			</div>
		</div>
	</form>
</section>
@endsection
