<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nigar vs. Orkhan</title>

        <link rel="apple-touch-icon" sizes="57x57" href="{{URL::asset('/images/contest/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{URL::asset('/images/contest/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{URL::asset('/images/contest/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{URL::asset('/images/contest/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{URL::asset('/images/contest/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{URL::asset('/images/contest/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{URL::asset('/images/contest/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{URL::asset('/images/contest/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('/images/contest/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{URL::asset('/images/contest/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('/images/contest/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{URL::asset('/images/contest/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('/images/contest/favicon-16x16.png')}}">
        <link rel="manifest" href="{{URL::asset('/images/contest/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{URL::asset('/images/contest/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Font Awesome -->
        <link href="{{URL::asset('/css/admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
        <!-- NProgress -->
        <link href="{{URL::asset('/css/admin/vendors/nprogress/nprogress.css')}}" rel="stylesheet" />

        <!-- Datatables -->
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet" />
        
        <!-- Switchery -->
        <link href="{{URL::asset('/css/admin/vendors/switchery/switchery.min.css')}}" rel="stylesheet" />
        
        <!-- Custom Theme Style -->
        <link href="{{URL::asset('/css/admin/custom.css')}}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                min-height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 44px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
            .row {
                margin: 5px 0;
            }
            
            .checkbox_container {
                text-align: left;
                padding-left: 15px;
            }
            
            .form-horizontal .control-label {
                text-align: left;
            }
            
            .user_name {
                text-align: left;
                line-height: 35px;
            }
            .btn {
                font-size: 25px;
            }
            .btn-primary {
                font-size: 25px;
            }
            
            .funkyradio {
                width: 80%;
                margin: 0 auto;
            }
            
            .funkyradio div {
                overflow: hidden;
              }

              .funkyradio label {
                width: 100%;
                border-radius: 3px;
                border: 1px solid #D1D3D4;
                font-weight: normal;
              }

              .funkyradio input[type="radio"]:empty,
              .funkyradio input[type="checkbox"]:empty {
                display: none;
              }

              .funkyradio input[type="radio"]:empty ~ label,
              .funkyradio input[type="checkbox"]:empty ~ label {
                position: relative;
                line-height: 2.5em;
                text-indent: 3.25em;
                margin-top: 2em;
                cursor: pointer;
                -webkit-user-select: none;
                   -moz-user-select: none;
                    -ms-user-select: none;
                        user-select: none;
              }

              .funkyradio input[type="radio"]:empty ~ label:before,
              .funkyradio input[type="checkbox"]:empty ~ label:before {
                position: absolute;
                display: block;
                top: 0;
                bottom: 0;
                left: 0;
                content: '';
                width: 2.5em;
                background: #D1D3D4;
                border-radius: 3px 0 0 3px;
              }

              .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
              .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
                color: #888;
              }

              .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
              .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
                content: '\2714';
                text-indent: .1em;
                color: #C2C2C2;
              }

              .funkyradio input[type="radio"]:checked ~ label,
              .funkyradio input[type="checkbox"]:checked ~ label {
                color: #777;
              }

              .funkyradio input[type="radio"]:checked ~ label:before,
              .funkyradio input[type="checkbox"]:checked ~ label:before {
                content: '\2714';
                text-indent: .1em;
                color: #333;
                background-color: #ccc;
              }

              .funkyradio input[type="radio"]:focus ~ label:before,
              .funkyradio input[type="checkbox"]:focus ~ label:before {
                box-shadow: 0 0 0 3px #999;
              }

              .funkyradio-default input[type="radio"]:checked ~ label:before,
              .funkyradio-default input[type="checkbox"]:checked ~ label:before {
                color: #333;
                background-color: #ccc;
              }

              .funkyradio-primary input[type="radio"]:checked ~ label:before,
              .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
                color: #fff;
                background-color: #337ab7;
              }

              .funkyradio-success input[type="radio"]:checked ~ label:before,
              .funkyradio-success input[type="checkbox"]:checked ~ label:before {
                color: #fff;
                background-color: #5cb85c;
              }

              .funkyradio-danger input[type="radio"]:checked ~ label:before,
              .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
                color: #fff;
                background-color: #d9534f;
              }

              .funkyradio-warning input[type="radio"]:checked ~ label:before,
              .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
                color: #fff;
                background-color: #f0ad4e;
              }

              .funkyradio-info input[type="radio"]:checked ~ label:before,
              .funkyradio-info input[type="checkbox"]:checked ~ label:before {
                color: #fff;
                background-color: #5bc0de;
              }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="title m-b-md">
                            Редактирование недостатка
                        </div>

                        <form class="form-horizontal form-label-left" action="{{url('contest/'.$flaw->id)}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <label class="control-label chk col-md-2 col-sm-2 col-xs-2">Автор: </label>
                                <div class="user_name col-md-10 col-sm-10 col-xs-10">{{$user_name}}</div>
                            </div>
                            <div class="row">
                                <input class="form-control" name="name" id="user_name_input" placeholder="Название" value="{{old('name', $flaw->name)}}"/>
                            </div>
                            <div class="row">
                                <textarea class="form-control" name="description" rows="10" placeholder="Описание">{{old('description', $flaw->description)}}</textarea>
                            </div>
                            <div class="row">
                                <div class="funkyradio">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="funkyradio-success">
                                                <input type="radio" name="acceptance" id="radio1" value="accepted" {{(old('accepted', $flaw->accepted) == 1)?'checked':''}} />
                                                <label for="radio1">Принять</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="funkyradio-danger">
                                                <input type="radio" name="acceptance" id="radio2" value="declined" {{(old('declined', $flaw->declined) == 1)?'checked':''}} />
                                                <label for="radio2">Отклонить</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="row"></div>
                            <div class="row"></div>
                            <div class="row">
                                <div class="panel-group" role="tablist">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                            <h4 class="panel-title">
                                                <a href="#collapseListGroup2" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseListGroup2">Комментарий <i class="fa fa-comments-o" aria-hidden="true"></i></a>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" role="tabpanel" id="collapseListGroup2" aria-labelledby="collapseListGroupHeading2" aria-expanded="true" style="">
                                            <textarea class="form-control" name="comment" rows="10">{{old('comment', $flaw->comment)}}</textarea>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">    
                                <a href="{{url('contest')}}" class="btn btn-primary">Отменить</a>
                                <button id="send" type="submit" class="btn btn-success">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{URL::asset('js/admin/vendors/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        
        <!-- Switchery -->
        <script src="{{URL::asset('js/admin/vendors/switchery/switchery.min.js')}}"></script>
        
        <script>
            var elem = document.querySelector('.js-switch');
            var init = new Switchery(elem);
        </script>
    </body>
</html>
