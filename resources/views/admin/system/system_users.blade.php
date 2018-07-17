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
                        <h2><a href="{{url('admin/system-users/create')}}"><i class="fa fa-plus"></i> Create</a></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-fixed-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email Address</th>
                                    <th>Fullname</th>
                                    <th>Status</th>
                                    <th>Group</th>
                                    <th class=" no-link last"><span class="nobr">Actions</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="">{{$user->id}}</td>
                                        <td class="">{{$user->email}}</td>
                                        <td class="">{{$user->name}} {{$user->surname}}</td>
                                        <td class="">{{($user->active) ? 'Active' : 'Inactive'}}</td>
                                        <td class="">{{$user->group->name}}</td>
                                        <td class="last"><a href="{{url('admin/system-users/'.$user->id.'/edit')}}"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="delete-link" href="javascript:void(0);" data-url="{{url('admin/system-users/'.$user->id)}}" data-return-url="{{url('admin/system-users')}}"><i class="fa fa-trash"></i></a></td>
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
<!-- /page content -->

@endsection