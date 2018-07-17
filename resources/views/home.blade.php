@extends('layouts.app')

@section('content')

@include('contest_users')

<section class="levels_container">
	<div class="container-fluid btns_container wrapper_container">
		@forelse ($levels as $level)
		<div class="row">
			<div class="col-xs-12 parent_btn">
				@php
					$user_levels = App\Models\UserLevel::where('user_id', '=', Auth::user()->id)->where('level_id', '=', $level->id)->get();
					$active = false;
					$completed = false;
					if ($user_levels->count() > 0) {
						$active = true;
						$completed = $user_levels->first()->completed;
					}
				@endphp
				<a class="btn @if ($active && !$completed) btn-success btn_success @elseif ($active && $completed) btn-info btn_info @else btn-default btn_default @endif btn_level" href="{{url('/level/'.$level->id)}}">{{$level->name}}</a>
				@if ($friend_id > 0)
					<a class="daisy" href="{{url('/level/'.$level->id.'/edit')}}"><img src="{{URL::asset('images/green_daisy.png')}}"/></a>
				@else
					<div class="daisy_fix"></div>
				@endif
			</div>
		</div>
		@empty
		<div class="row">
			<div class="col-xs-12 parent_btn">No levels</div>
		</div>
		@endforelse		
		@if ($friend_id > 0)
		<div class="row">
			<div class="col-xs-12 parent_btn">
				<a class="btn btn-primary btn_plus" href="{{url('/level/create')}}">+</a>
			</div>
		</div>
		@endif
	</div>
</section>
@endsection
