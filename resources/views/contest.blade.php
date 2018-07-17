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
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Datatables -->
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/css/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet" />

        <!-- Font Awesome -->
        <link href="{{URL::asset('/css/admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />

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

            .control_label {
                font-weight: bold;
                line-height: 30px;
            }
            
            .table-striped th:first-child {
                /*width: 80%;*/
            }
            .table-striped th:nth-child(2) {
                width: 68px;
            }
            .table-striped th:last-child {
                width: 15px;
            }
            .score {
                font-size: 50px;
            }
            .score.nigar {
                color: #449d44;
                font-family: sans-serif;
            }
            .score.orkhan {
                color: #31b0d5;
                font-family: sans-serif;
            }
            .row.scoreboard_parent {
                text-align: center;
            }
            .scoreboard {
                text-align: center;
                float: none;
                width: 60%;
                margin: 0 auto;
            }
            .btn-primary {
                font-size: 25px;
            }
            .base_link {
                color: #0b0c0c;
            }
            .base_link:hover {
                text-decoration: none;
            }
        </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <a class="base_link" href="{{ url('/contest') }}">Nigar vs. Orkhan</a>
            </div>
            <div class="row scoreboard_parent">
                <div class="scoreboard">
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="score nigar">{{$nigar_flaws_count}}</div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="score">:</div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="score orkhan">{{$orkhan_flaws_count}}</div>
                    </div>
                </div>
            </div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    Nigar - {{$nigar_flaws_count}}
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$nigar_flaws_percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$nigar_flaws_percent}}%">
                            <span>{{$nigar_flaws_percent}} %</span>
                        </div>
                    </div>
                    Orkhan - {{$orkhan_flaws_count}}
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{$orkhan_flaws_percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$orkhan_flaws_percent}}%">
                            <span>{{$orkhan_flaws_percent}} %</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 cols-sm-12 col-xs-12">
                    <a href="{{url('contest/create')}}" class="btn btn-primary">Добавить</a>
                </div>
            </div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-group" role="tablist">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                                <h4 class="panel-title">
                                    <a href="#collapseListGroup1" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseListGroup1">Недостатки Нигяр</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" role="tabpanel" id="collapseListGroup1" aria-labelledby="collapseListGroupHeading1" aria-expanded="true" style="">
                                <table id="datatable-fixed-header-1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Название</th>
                                            <th>Принят</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($nigar_flaws as $nigar_flaw)
                                        <tr>
                                            <td class="">
                                                <a href="{{url('contest/'.$nigar_flaw->id.'/edit')}}">{{$nigar_flaw->name}}
                                                    @if (isset($nigar_flaw->comment) && $nigar_flaw->comment != '')
                                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="">
                                                @if ($nigar_flaw->accepted)
                                                    <span style="color: rgb(51, 153, 0);"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                @elseif ($nigar_flaw->declined)
                                                    <span style="color: rgb(204, 0, 0);"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-group" role="tablist">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
                                <h4 class="panel-title">
                                    <a href="#collapseListGroup2" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseListGroup2">Недостатки Орхана</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" role="tabpanel" id="collapseListGroup2" aria-labelledby="collapseListGroupHeading2" aria-expanded="true" style="">
                                <table id="datatable-fixed-header-2" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Название</th>
                                            <th>Принят</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orkhan_flaws as $orkhan_flaw)
                                        <tr>
                                            <td class="">
                                                <a href="{{url('contest/'.$orkhan_flaw->id.'/edit')}}">{{$orkhan_flaw->name}}
                                                    @if (isset($orkhan_flaw->comment) && $orkhan_flaw->comment != '')
                                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="">
                                                @if ($orkhan_flaw->accepted)
                                                    <span style="color: rgb(51, 153, 0);"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                @elseif ($orkhan_flaw->declined)
                                                    <span style="color: rgb(204, 0, 0);"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
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
    </div>

<script src="{{URL::asset('js/admin/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

<!-- FastClick -->
<script src="{{URL::asset('js/admin/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{URL::asset('js/admin/vendors/nprogress/nprogress.js')}}"></script>

<!-- Datatables -->
<script src="{{URL::asset('js/admin/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/datatables.net/js/dataTables_initialize.js')}}"></script>

<script src="{{URL::asset('js/admin/vendors/jszip/dist/jszip.min.js')}}"></script>

<script src="{{URL::asset('js/admin/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('js/admin/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

<!-- Switchery -->
<script src="{{URL::asset('js/admin/vendors/switchery/switchery.min.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{URL::asset('js/admin/custom.min.js')}}"></script>
<script src="{{URL::asset('js/admin/scripts.js')}}"></script>
</body>
</html>
