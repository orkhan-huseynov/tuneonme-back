@extends('layouts.app')

@section('content')
<section>
	<div class="container-fluid wrapper_container">
		<div class="row wrapper_container__row">
			<div class="col-xs-12 notifications_list_wrapper">
				<h5>Notifications</h5>
				<div class="notifications_list_container">
					@if (count($notifications) == 0)
						<div class="center_contents">No notifications yet</div>
					@endif
					@foreach ($notifications as $notification)
						<a href="{{url('/notification/'.$notification->id)}}">
							<div class="notifications_list_item">
								<div class="notifications_list_item__text">{!!$notification->notification_text!!}</div>
								<div class="notifications_list_item__date">{{$notification->created_at->diffForHumans()}}</div>
							</div>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
