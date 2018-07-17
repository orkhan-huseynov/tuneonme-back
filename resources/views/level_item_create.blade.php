@extends('layouts.app')

@section('content')

@include('contest_users')

<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="level_heading">Level: {{$level->name}}, <span class="h1_addition">new item</span></h1>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container-fluid wrapper_container">
		<div class="row">
			<div class="col-xs-12">
				<form action="{{url('level_item')}}" method="post" name="add_item_form">
					{{ csrf_field() }}
					<input type="hidden" name="level_id" value="{{$level->id}}" />
					<p><input type="text" placeholder="Title" name="title" class="form-control" value="{{old('title')}}"/></p>
					<p><textarea cols="20" rows="10" placeholder="Description" class="form-control" name="description">{{old('description')}}</textarea></p>
					<p class="form_add_level__center">
						<input type="submit" name="submit" value="Submit" class="btn btn-success btn__submit"/>
						<a href="{{url('level/'.$level->id)}}" class="btn btn-danger btn__cancel">Cancel</a>
					</p>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection