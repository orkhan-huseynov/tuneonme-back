@extends('layouts.app')

@section('content')

@include('contest_users')

<section>
    <div class="container-fluid wrapper_container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="level_heading">{{$level->name}}</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid wrapper_container">
        <div class="row">
            <div class="col-xs-12 victory_image_container">
                <a href="{{url('/level/prize/'.$level->id)}}"><img src="{{URL::asset('images/goblet.png')}}" alt="Victory" class="victory_image"/></a>
            </div>
        </div>
    </div>
    <div class="container-fluid wrapper_container">
        <div class="row">
            <div class="col-xs-12">
                <div class="digits_container">
                    <div class="digits"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid wrapper_container">
        <div class="row">
            <div class="col-xs-12 btn_add_container">
                @if ($level_completed && $won_user_id == Auth::user()->id)
                <h4 class="center_content">You won!</h4>
                <a class="btn btn-success" href="{{url('/level/prize/'.$level->id)}}">Prize acceptance</a>
                @elseif ($level_completed && $won_user_id == $friend->id)
                <h4 class="center_content">{{$friend->name}} won!</h4>
                <a class="btn btn-success" href="{{url('/level/prize/'.$level->id)}}">Prize page</a>
                @else
                <a class="btn btn-success" href="{{url('/level_item/create_level_item/'.$level->id)}}">Add</a>
                @endif
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
                        <div class="panel-heading panel_heading" role="tab" id="first_panel_heading">
                            <a href="#first_panel_body" class="panel_heading__link" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="#first_panel_body">
                                <h3 class="panel-tittle panel_heading__title"><span {{(App\Models\Level::unreviewed_items_count($level->id, Auth::user()->id) > 0)? 'class=span_badge':''}} data-count="{{App\Models\Level::unreviewed_items_count($level->id, Auth::user()->id)}}">{{Auth::user()->name}}</span></h3>
                            </a>
                        </div>
                        <div class="panel-collapse collapse" role="tabpanel" id="first_panel_body" aria-labelledby="first_panel_heading" aria-expanded="true" style="">
                            <table id="datatable-fixed-header-1" class="table table-striped table-bordered items_table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($current_user_level_items as $current_user_level_item) 
                                    <tr>
                                        <td><a href="{{url('/level_item/'.$current_user_level_item->id)}}">{{$current_user_level_item->title}}</a></td>
                                        <td>
                                            @if ($current_user_level_item->accepted)
                                            <i class="fa fa-check accept_item" aria-hidden="true"></i>
                                            @elseif ($current_user_level_item->declined)
                                            <i class="fa fa-times decline_item" aria-hidden="true"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($current_user_level_item->comment))
                                            <a href="{{url('/level_item/'.$current_user_level_item->id)}}">
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach									
                                </tbody>
                            </table>
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
                                <h3 class="panel-tittle panel_heading__title"><span {{(App\Models\Level::unreviewed_items_count($level->id, $friend->id) > 0)? 'class=span_badge':''}} data-count="{{App\Models\Level::unreviewed_items_count($level->id, $friend->id)}}">{{$friend->name}}</span></h3>
                            </a>
                        </div>
                        <div class="panel-collapse collapse" role="tabpanel" id="second_panel_body" aria-labelledby="first_panel_heading" aria-expanded="true" style="">
                            <table id="datatable-fixed-header-2" class="table table-striped table-bordered items_table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($friend_level_items as $friend_level_item)
                                    <tr>
                                        <td><a href="{{url('/level_item/'.$friend_level_item->id)}}">{{$friend_level_item->title}}</a></td>											
                                        <td>
                                            @if ($friend_level_item->accepted)
                                            <i class="fa fa-check accept_item" aria-hidden="true"></i>
                                            @elseif ($friend_level_item->declined)
                                            <i class="fa fa-times decline_item" aria-hidden="true"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($friend_level_item->comment))
                                            <a href="{{url('/level_item/'.$friend_level_item->id)}}">
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
    $(".digits").countdown({
    image: "{{URL::asset('images/digits.png')}}",
            startTime: "{{str_pad(App\Models\Level::score($level->id, $friend->id), 2, "0", STR_PAD_LEFT)}}:{{str_pad(App\Models\Level::score($level->id, Auth::user()->id), 2, "0", STR_PAD_LEFT)}}",
            format: "dd:hh:mm:ss",
            start: false
    });
    });
</script>
@endsection
