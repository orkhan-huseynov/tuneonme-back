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
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
	
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
		{{ csrf_field() }}
		
		<div class="container-fluid container_form wrapper_container">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input type="text" placeholder="Email" name="email" class="form-control" value="{{ old('email') }}" required autofocus />
						
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 container_form__submit_btn">
					<input type="submit" name="submit" value="Send Password Reset Link" class="btn btn-success"/>
					<a class="btn btn-link" href="{{ url('/login') }}">
						Already Remembered?
					</a>
				</div>
			</div>
		</div>
	</form>
</section>
@endsection
