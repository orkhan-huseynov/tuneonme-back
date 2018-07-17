@extends('layouts.app')

@section('content')
<section>
	<div class="container-fluid wrapper_container">
		<div class="row wrapper_container__row">
			<div class="col-xs-12 wrapper_container__column notifications_list_wrapper">
				<h3 class="center_contents">User has an active connection</h3>
				<p class="error_body">
					This user already has an active connection. We sent a notification for user to know that you want to accept the request.
				</p>
			</div>
		</div>
	</div>
</section>
@endsection
