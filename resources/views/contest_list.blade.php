<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nigar vs. Orkhan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />

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
                font-weight: normal;
                line-height: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="content">
                <div class="title m-b-md">
                    Nigar vs. Orkhan -1
                </div>
                
                Nigar - {{$nigar_flaws_count}}
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$nigar_flaws_count}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$nigar_flaws_count}}%">
                      <span>{{$nigar_flaws_count}}</span>
                    </div>
                  </div>
                  Orkhan - {{$orkhan_flaws_count}}
                  <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{$orkhan_flaws_count}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$orkhan_flaws_count}}%">
                      <span>{{$orkhan_flaws_count}}</span>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        
        <script src="{{URL::asset('js/admin/vendors/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>
