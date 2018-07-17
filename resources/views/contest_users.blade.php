<section class="users_section">
	<div class="container-fluid wrapper_container">
		<div class="row wrapper_container__row">
			<div class="col-xs-5 wrapper_container__column">
				@if ((Auth::user()->friends->count() > 0) && (Auth::user()->friendsAccepted->count() > 0 || Auth::user()->friendOfAccepted->count() > 0))
					@php $friend_user = (Auth::user()->friendsAccepted->count() > 0)? Auth::user()->friendsAccepted->first() : Auth::user()->friendOfAccepted->first() @endphp
                                        <div class="row">
                                                @if ($friend_user->profile_picture != '')
                                                <a href="{{url('/profile/'.$friend_user->id)}}"><div style="background: url('{{Storage::url('images/'.$friend_user->profile_picture)}}');background-size:cover;" class="img-circle thumb-image-small"></div></a>
                                                @else
                                                <a href="{{url('/profile/'.$friend_user->id)}}"><div style="background: url('{{URL::asset('images/default_profile.png')}}');background-size:cover;" class="img-circle thumb-image-small"></div></a>
                                                @endif
                                        </div>
                                        <div class="row">
                                                <p class="user_id left_user_string">
                                                    <a class="users_names" href="{{url('/profile/'.$friend_user->id)}}">{{$friend_user->name}} {{$friend_user->lastname}}</a>  <a href="javascript:void(0);" id="delete_user_modal_link" data-user_name="{{$friend_user->name}} {{$friend_user->lastname}}"><i class="fa fa-times delete_user" aria-hidden="true"></i></a>
                                                </p>
                                                <p class="user_id left_user_string">Id: <span class="user_pid">{{$friend_user->personal_id}}</span></p>
                                        </div>
                                        
                                        
                                        
				@else
					<form method="post" action="javascript:void(0);" name="form_search" id="search_user_form">
						<div class="input-group search_user_input_group">
							<input name="search_id" placeholder="id" type="text" id="search_user_pid" class="form-control form_search__input"/>
							<div class="search_user_result"><i class='fa fa-circle-o-notch fa-spin'></i></div>
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" id="search_user_button"><i class="fa fa-search" aria-hidden="true"></i></button>
							</span>
						</div>
					</form>
				@endif
			</div>
			<div class="col-xs-2 parent_vs_icon wrapper_container__column">
				<img class="vs_icon" src="{{URL::asset('images/vs_icon.png')}}" alt="vs"/>
			</div>
			<div class="col-xs-5 wrapper_container__column">
                            <div class="row">
                                
                                    @if (Auth::user()->profile_picture != '')
                                    <a href="{{url('/profile/'.Auth::user()->id)}}"><div style="background: url('{{Storage::url('images/'.Auth::user()->profile_picture)}}');background-size:cover;" class="img-circle thumb-image-small"></div></a>
                                    @else
                                    <a href="{{url('/profile/'.Auth::user()->id)}}"><div style="background: url('{{URL::asset('images/default_profile.png')}}');background-size:cover;" class="img-circle thumb-image-small"></div></a>
                                    @endif
                            </div>
                            <div class="row">
                                    <p class="user_id"><a class="users_names" href="{{url('/profile/'.Auth::user()->id)}}">{{{ isset(Auth::user()->name) ? Auth::user()->name . ' ' . Auth::user()->lastname : Auth::user()->email }}}</a></p>
                                    <p class="user_id">Id: <span class="user_pid">{{Auth::user()->personal_id}}</span></p>
                            </div>
                            
                        </div>
                </div>
	</div>
</section>
