@extends('layouts.app')

@section('content')
<section class="profile_container">
    <div class="container-fluid wrapper_container">
        <div class="row wrapper_container__row">
            <div class="col-xs-12 wrapper_container__column">
                <div class="prodile_controls center_contents">
                    @if (Auth::user()->id == $user->id)
                    <label for="userpic-file-input" class="userpic_label">
                        <div class="profile_pic_container">
                            @if ($user->profile_picture != '')
                            <div style="background: url('{{Storage::url('images/'.$user->profile_picture)}}');background-size:cover;" class="img-circle thumb-image"></div>
                            @else
                            <div style="background: url('{{URL::asset('images/default_profile.png')}}');background-size:cover;" class="img-circle thumb-image"></div>
                            @endif
                        </div>
                    </label>
                    <div class="userpic_input">
                        <form name="profile_pic_form" method="post" id="profile-pic-form" action="{{URL('/profile/save_profile_pic')}}">
                            <input id="userpic-file-input" type="file" name="userpic" accept="image/*" />
                        </form>
                    </div>
                    @else
                    <div class="profile_pic_container">
                        @if ($user->profile_picture != '')
                        <div style="background: url('{{Storage::url('images/'.$user->profile_picture)}}');background-size:cover;" class="img-circle thumb-image"></div>
                        @else
                        <div style="background: url('{{URL::asset('images/default_profile.png')}}');background-size:cover;" class="img-circle thumb-image"></div>
                        @endif
                    </div>
                    @endif
                </div>
                <h3 class="center_contents">{{$user->name .'&nbsp;'. $user->lastname}}</h3>
                <p class="profile_field">
                    <span class="profile_field__title">Member since:&nbsp;</span>{{$user->created_at->toFormattedDateString()}}
                </p>
            </div>
        </div>
        <div class="row wrapper_container__row profile_stats_row">
            <div class="col-xs-6">
                <div class="profile_stats_circle">
                    <div class="profile_stats_circle__value"><strong>{{$levels_completed}}</strong></div>
                    <div class="profile_stats_circle__title">levels completed</div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="profile_stats_circle">
                    <div class="profile_stats_circle__value"><strong>{{$levels_won}}</strong></div>
                    <div class="profile_stats_circle__title">levels won</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
