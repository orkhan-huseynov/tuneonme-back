@extends('layouts.app')

@section('content')
<section>
	<div class="container-fluid wrapper_container">
		<div class="row wrapper_container__row">
			<div class="col-xs-12 notifications_list_wrapper">
				<h5>Connection requests</h5>
				<div class="connection_request_list_container">
					@if (count($connection_requests) == 0)
						<div class="center_contents">No requests yet</div>
					@endif
					@foreach ($connection_requests as $connection_request)
						<a href="{{url('/connection_request/'.$connection_request->id)}}">
							<div class="connection_request_list_item">
								<div class="container-fluid">
									<div class="row">
										<div class="col-xs-6">
											<div class="connection_request_list_item__text">{{App\Models\User::findOrFail($connection_request->user_id)->name .'&nbsp;'. App\Models\User::findOrFail($connection_request->user_id)->lastname}}</div>
											<div class="connection_request_list_item__date">{{$connection_request->created_at->diffForHumans()}}</div>
										</div>
										<div class="col-xs-6">
											<div class="connection_request_list_item__actions"><a class="btn btn-success" href="{{url('/connection_request/accept/'.$connection_request->id)}}">Accept</a><a class="btn btn-danger" href="{{url('/connection_request/delete/'.$connection_request->id)}}">Delete</a></div>
										</div>
									</div>
								</div>
							</div>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
