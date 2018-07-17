@extends('layouts.app')

@section('content')

@include('contest_users')

<section>    
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="section_top__heading_sub new_level__heading_sub">Level: {{$level->name}}</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h1 class="level_heading">{{$level_item->title}}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<p class="section_top__heading_sub new_level__heading_sub">{{$level_item->description}}</p>
			</div>
		</div>
	</div>
</section>
@if($level_item->user_id != Auth::user()->id)
	<section>
		<div class="container-fluid wrapper_container">
			<div class="row">
				<div class="col-xs-12">
						<form action="{{url('level_item/'.$level_item->id)}}" method="post" name="accept_decline_form" id="level_item_accept_decline_form">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<input type="hidden" name="level_id" value="{{$level->id}}" />
						<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
							@if(!$level_item->accepted && !$level_item->declined)
								<textarea cols="20" rows="10" name="comment" placeholder="Explain" class="form-control">{{old('comment', $level_item->comment)}}</textarea>
								@if ($errors->has('level_name'))
									<span class="help-block">
										<strong>{{ $errors->first('comment') }}</strong>
									</span>
								@endif
							@else
								<p>Comment:</p>
								<div class="level_item_comment">{{$level_item->comment}}</div>
							@endif
						</div>
						<div class="hidden">
							<input type="radio" name="acceptance" id="level_item_radio_accepted" value="accepted" {{(old('accepted', $level_item->accepted) == 1)?'checked':''}} />
							<input type="radio" name="acceptance" id="level_item_radio_declined" value="declined" {{(old('declined', $level_item->declined) == 1)?'checked':''}} />
						</div>
						
						<p class="form_add_level__center">
							@if(!$level_item->accepted && !$level_item->declined)
                            <button name="submit" id="btn_accept_level_item" class="btn btn-success btn__submit">Accept</button>
							<button name="decline" id="btn_decline_level_item" class="btn btn-danger btn__cancel">Decline</button>
							@endif
						</p>						
					</form>
				</div>
			</div>
		</div>
	</section>
@else
	<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<p>Comment:</p>
				<div class="level_item_comment">{{$level_item->comment}}</div>
			</div>
		</div>
	</div>
	</section>
@endif
<p class="back_button_paragraph"><a class="btn btn-default" href="{{url('/level/'.$level->id)}}">Back to {{$level->name}}</a></p>
@endsection