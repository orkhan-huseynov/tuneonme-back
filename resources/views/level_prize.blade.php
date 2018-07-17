@extends('layouts.app')

@section('content')

@include('contest_users')

<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="level_heading">Prize</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h3 class="section_top__heading_sub prize_heading_sub">Koroche tak, tut vashi prizi,kak tolko kto-to iz vas viiqraet, aktiviziruetsa knopochka prinat podarok, i poka pobedivshiy ne podtverdit to cto poluchil svoy podarok, nevozmojno budet pereuti na noviy uroven</h3>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12 goblet_container">
				<img src="{{url::asset('images/goblet.png')}}" alt="Victory" class="prize_image"/>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group" role="tablist">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="first_panel_heading">
							<a href="#first_panel_body" class="panel_heading__link" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="#first_panel_body">
								<h3 class="panel-tittle panel_heading__title">{{Auth::user()->name}}</h3>
							</a>
						</div>
						<div class="panel-collapse collapse prize_description_container" role="tabpanel" id="first_panel_body" aria-labelledby="first_panel_heading" aria-expanded="true" style="">
							<p>{{$current_user_prize}}</p>
							@if ($won_user_id == Auth::user()->id)
								@if (!$current_user_prize_accepted && !$current_user_prize_not_accepted)
									<a href="{{url('/level/got_my_prize/'.$level->id)}}" class="btn btn-success">Got my prize!</a>
									&nbsp;
									<a href="{{url('/level/not_got_my_prize/'.$level->id)}}" class="btn btn-default">Did not get my prize :(</a>
								@elseif ($current_user_prize_accepted)
									<a href="javascript:void(0);" class="btn btn-default" disabled="disabled">You got your prize!</a>
								@elseif ($current_user_prize_not_accepted)
									<a href="javascript:void(0);" class="btn btn-default" disabled="disabled">You did not get your prize :(</a>
								@endif
							@endif
						</div>
					</div>
				</div>    
			</div>
		</div>
	</div>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel-group" role="tablist">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="second_panel_heading">
							<a href="#second_panel_body" class="panel_heading__link" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="#second_panel_body">
							   <h3 class="panel-tittle panel_heading__title">{{$friend->name}}</h3>
							</a>
						</div>
						<div class="panel-collapse collapse prize_description_container" role="tabpanel" id="second_panel_body" aria-labelledby="first_panel_heading" aria-expanded="true" style="">
							<p>{{$friend_prize}}</p>
						</div>
					</div>
				</div>    
			</div>
		</div>
	</div>
</section>
@endsection
