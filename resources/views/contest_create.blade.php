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
        <link rel="apple-touch-icon" sizes="76x76" href="{{URL::asset('/images/contest/apple-touch-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{URL::asset('/images/contest/apple-touch-icon-114x114.png')}}">
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

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #0b0c0c;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
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
                font-size: 40px;
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
            
            .control_label {
                font-weight: normal;
                line-height: 30px;
            }
            .btn {
                font-size: 25px;
            }
            .btn-primary {
                font-size: 25px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="title m-b-md">
                            Новый недостаток
                        </div>

                        <form class="form-horizontal form-label-left" action="{{url('contest')}}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <select name="user_id" class="form-control" id="user_id_select">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <input class="form-control" name="name" id="user_name_input" placeholder="Название"/>
                            </div>
                            <div class="row">
                                <textarea class="form-control" name="description" rows="10" placeholder="Описание"></textarea>
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
    </body>
</html>
