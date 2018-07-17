@extends('admin.layouts.layout')

@section('title', 'System Users')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    System Users
                </h3>
            </div>

            <div class="title_right">
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit User</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{url('admin/system-users/'.$user->id)}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="grpoup">Group <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="group" class="form-control col-md-7 col-xs-12" minlength="6" name="group" required>
                                        @foreach ($groups as $group)
                                            <option value="{{$group->id}}" {{(old('group', $user->group_id) == $group->id) ? 'selected':''}}>{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group {{$errors->has('name')?'has-error':''}}">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Name <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" minlength="3" name="name" required type="text" value="{{old('name', $user->name)}}" />
                                    <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="item form-group {{$errors->has('surname')?'has-error':''}}">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="surname">Surname <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="surname" class="form-control col-md-7 col-xs-12" minlength="3" name="surname" required type="text" value="{{old('surname', $user->surname)}}" />
                                    <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('surname')}}</span>
                                </div>
                            </div>
                            <div class="item form-group {{$errors->has('lastname')?'has-error':''}}">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="lastname">Last name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lastname" class="form-control col-md-7 col-xs-12" minlength="3" name="lastname" type="text" value="{{old('lastname', $user->lastname)}}" />
                                    <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('lastname')}}</span>
                                </div>
                            </div>
                            <div class="item form-group {{$errors->has('email')?'has-error':''}}">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{old('email', $user->email)}}" />
                                    <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('email')}}</span>
                                </div>
                            </div>
                            <div class="item form-group {{$errors->has('password')?'has-error':''}}">
                                <label for="password" class="control-label col-md-2 col-sm-2 col-xs-12">New password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" type="password" name="password" minlength="6" class="form-control col-md-7 col-xs-12" />
                                    <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('password')}}</span>
                                </div>
                            </div>
                            <div class="item form-group {{$errors->has('password2')?'has-error':''}}">
                                <label for="password2" class="control-label col-md-2 col-sm-2 col-xs-12">Repeat Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password2" type="password" name="password2" minlength="6" class="form-control col-md-7 col-xs-12" />
                                    <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('password2')}}</span>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="active" class="control-label col-md-2 col-sm-2 col-xs-12">Active</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 checkbox_container">
                                    <input id="active" type="checkbox" name="active" class="js-switch form-control" {{(old('active', $user->active) == 1)?'checked':''}} />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-1">
                                    <a href="{{url('admin/system-users')}}" class="btn btn-primary">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@endsection