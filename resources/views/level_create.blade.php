@extends('layouts.app')

@section('content')

@include('contest_users')

<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="level_heading">New Level</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h3 class="section_top__heading_sub new_level__heading_sub">Enter your data to create a new level</h3>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<form action="{{url('level')}}" method="post" name="form_add_level">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('level_name') ? ' has-error' : '' }}">
						<input type="text" placeholder="Level Name" name="level_name" class="form-control" value="{{old('level_name')}}" required/>
						@if ($errors->has('level_name'))
							<span class="help-block">
								<strong>{{ $errors->first('level_name') }}</strong>
							</span>
						@endif
					</div>
					<div class="form_add_level__center form-group{{ $errors->has('points_to_win') ? ' has-error' : '' }}">
						<label for="points_to_win_id">Points To Win</label>
						<input type="number" min="5" max="100" name="points_to_win" class="form-control points_to_win__input" id="points_to_win_id" value="{{old('points_to_win', 15)}}" required/>
						@if ($errors->has('points_to_win'))
							<span class="help-block">
								<strong>{{ $errors->first('points_to_win') }}</strong>
							</span>
						@endif
					</div>
					<p>
						<div class="form-group{{ $errors->has('level_prize') ? ' has-error' : '' }}">
							<textarea cols="15" rows="5" placeholder="Prize For Level" name="level_prize" class="form-control" required>{{old('level_prize')}}</textarea>
							@if ($errors->has('level_prize'))
								<span class="help-block">
									<strong>{{ $errors->first('level_prize') }}</strong>
								</span>
							@endif
						</div>
					</p>
					<p class="form_add_level__center">
						<input type="submit" name="submit" value="Submit" class="btn btn-success btn__submit"/>
						<a class="btn btn-danger btn__cancel" href="{{url('/')}}">Cancel</a>
					</p>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection