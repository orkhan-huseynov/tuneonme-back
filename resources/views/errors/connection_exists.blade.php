@extends('layouts.app')

@section('content')
<section>
	<div class="container-fluid wrapper_container">
		<div class="row wrapper_container__row">
			<div class="col-xs-12 wrapper_container__column notifications_list_wrapper">
				<h3 class="center_contents">Active connection exists</h3>
				<p class="error_body">
					You can only connect to one user at a time. Delete active connections to make a new one.
				</>
			</div>
		</div>
	</div>
</section>
@endsection
