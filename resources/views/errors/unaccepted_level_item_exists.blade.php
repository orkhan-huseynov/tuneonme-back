@extends('layouts.app')

@section('content')
<section>
	<div class="container-fluid wrapper_container">
		<div class="row wrapper_container__row">
			<div class="col-xs-12 wrapper_container__column notifications_list_wrapper">
				<h3 class="center_contents">Cannot add level item</h3>
				<p class="error_body">
					This level contains items that were not accepted or declined yet.
				</p>
				<p class="error_body">
					<a class="btn btn-default" href="{{url('/level/'.$level->id)}}">Back to {{$level->name}}</a>
				</p>
			</div>
		</div>
	</div>
</section>
@endsection
