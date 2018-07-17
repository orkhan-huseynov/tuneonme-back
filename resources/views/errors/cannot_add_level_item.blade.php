@extends('layouts.app')

@section('content')
<section>
	<div class="container-fluid wrapper_container">
		<div class="row wrapper_container__row">
			<div class="col-xs-12 wrapper_container__column notifications_list_wrapper">
				<h3 class="center_contents">Cannot add level item</h3>
				<p class="error_body">
					Cannot add level item. Level either completed or you are not assigned to it.
				</p>
			</div>
		</div>
	</div>
</section>
@endsection
