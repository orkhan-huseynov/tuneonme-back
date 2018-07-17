<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <!-- <link href="/css/app.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="/css/main.css" media="all" />
        <link rel="stylesheet" href="/css/media.css" media="all" />

        <!-- Scripts -->
        <script>
            window.Laravel = <?php
                echo json_encode([
                    'csrfToken' => csrf_token(),
                ]);
            ?>
        </script>
		<script src="https://use.fontawesome.com/e91813dcef.js"></script>
        <!-- <script src="{{URL::asset('/js/app.js')}}"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="{{URL::asset('/js/countdown.js')}}"></script>
		<script src="{{URL::asset('/js/scripts.js')}}"></script>
		
    </head>
    <body id="body" data-base_url="{{url('/')}}">
        <div class="se-pre-con"></div>
        <header class="gradient_background">
            <div class="container-fluid wrapper_container" id="app">
                <div class="row header__top_row">
                    <div class="col-xs-7">
						@if (!Auth::guest())
						@php $unread_notification_count = App\Models\Notification::where('user_id', '=', Auth::user()->id)->where('viewed', '=', false)->get()->count(); @endphp
						<div class="notifications_bar_group">
							<a class="icons_green notification_bell" id="notification_bell_toggle" href="javascript:void(0);"><i class="fa fa-heart-o {{($unread_notification_count > 0)?'icon_badge':''}}" aria-hidden="true" data-count="{{$unread_notification_count}}"></i></a>
							<div class="notifications_container">
								<div class="notifications_container__triangle"></div>
								<div class="notifications_container__panel">
									<div class="panel_header">
										<div class="panel_header__left">Notifications</div>
										<div class="panel_header__right"><a href="{{url('/notification')}}">See all</a></div>
										<div class="clearfix"></div>
									</div>
									<div class="panel_body_container">
										<div class="panel_body">
										</div>    
									</div>
								</div>
							</div>
						</div>
						@php $requests_count = App\Models\Friend::where('friend_id', '=', Auth::user()->id)->where('accepted', '=', 0)->count() @endphp
						<div class="connection_requests_bar_group">
							<a class="icons_green connections_requests_icon" id="connection_requests_toggle" href="javascript:void(0);"><i class="fa fa-hand-spock-o {{($requests_count > 0)?'icon_badge':''}}" aria-hidden="true" data-count="{{$requests_count}}"></i></a>
							<div class="connection_requests_container">
								<div class="connection_requests__triangle"></div>
								<div class="connection_requests__panel">
									<div class="panel_header">
										<div class="panel_header__left">Connection requests</div>
										<div class="panel_header__right"><a href="{{url('/connection_request')}}">See all</a></div>
										<div class="clearfix"></div>
									</div>
									<div class="panel_body_container">
										<div class="panel_body">
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-3">
                        @if (Auth::guest())
                        <a class="btn btn-success header__top_row__btn btn_success" href="{{url('/register')}}" role="button">Sign Up</a>
                        @else
                        <a class="btn btn-success header__top_row__btn btn_success" href="{{ route('logout') }}" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="header__logo">
                <a href="{{url('/')}}"><img src="{{URL::asset('images/logo.png')}}" alt="Logo"/></a>
            </div>
        </header>
        @yield('content')
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 footer__copy">
                        <a href="{{url('/')}}">Tune On Me</a> &copy; 2017
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bind to user modal -->
        <div class="modal fade" id="bind_to_user_modal" tabindex="-1" role="dialog" aria-labelledby="bindToUserLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content delete_user_modal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="bindToUserLabel">Connect to %user_name%?</h4>
                    </div>
                    <div class="modal-body">
                        By sending connection request you invite this user to take part in competition. Please note that you won`t be able to connect to multiple users at the same time. 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="bind_to_user_modal__confirm">Send request</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bind to user result modal -->
        <div class="modal fade" id="bind_to_user_result_modal" tabindex="-1" role="dialog" aria-labelledby="bindToUserResultLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content delete_user_modal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="bindToUserResultLabel">Connect to %user_name%</h4>
                    </div>
                    <div class="modal-body" id="bindToUserResultModalBody">
                        %modal_body%
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete user modal -->
        <div class="modal fade" id="delete_user_modal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content delete_user_modal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteUserModalLabel">Are you sure you want to execute %user_name%?</h4>
                    </div>
                    <div class="modal-body" id="deleteUserModalBody">
                        If you delete %user_name% you won`t be able to resume your competition. All saved results will be deleted.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Show mercy</button>
                        @if (!Auth::guest() && (Auth::user()->friendsAccepted->count() > 0 || Auth::user()->friendOfAccepted->count() > 0))
							@php $friend_user = (Auth::user()->friendsAccepted->count() > 0)? Auth::user()->friendsAccepted->first() : Auth::user()->friendOfAccepted->first() @endphp
							<button type="button" class="btn btn-danger" id="delete_user_modal__exterminate" data-user_to_delete="{{$friend_user->id}}">Exterminate</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete user result modal -->
        <div class="modal fade" id="delete_user_result_modal" tabindex="-1" role="dialog" aria-labelledby="deleteUserResultModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content delete_user_modal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteUserResultModalLabel">Executing %user_name%</h4>
                    </div>
                    <div class="modal-body" id="deleteUserResultModalBody">
                        %modal_body%
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accept request result modal -->
        <div class="modal fade" id="accept_request_result_modal" tabindex="-1" role="dialog" aria-labelledby="acceptRequestResultModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content delete_user_modal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="acceptRequestResultModalLabel">Request from %user_name%</h4>
                    </div>
                    <div class="modal-body" id="acceptRequestResultModalBody">
                        %modal_body%
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
         

		
    </body>
</html>
