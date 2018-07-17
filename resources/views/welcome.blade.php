@extends('layouts.app', ['body_class' => 'welcome_body'])

@section('content')
<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="welcome_heading">Welcome</h1>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="welcome_text">My funny valentine. Sweet comic valentine. You make me smile from my heart. You look so laughable, unphotographable. And your my favourite work of art.</h3>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12 btn_start_container">
				<a class="btn btn-success btn_start" href="{{url('/')}}">Tune On Me!</a>
			</div>
		</div>
	</div>
</section>
@endsection
