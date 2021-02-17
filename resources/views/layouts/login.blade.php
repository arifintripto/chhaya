<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('concave.cnf_appname') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="{{ asset('concave5/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('concave5/css/core.css')}}" rel="stylesheet">
    <link href="{{ asset('concave5/js/plugins/iCheck/skins/square/green.css')}}" rel="stylesheet">
    <link href="{{ asset('concave5/js/plugins/toast/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{ asset('concave5/fonts/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Concave 5 Main CSS -->
    <script type="text/javascript" src="{{ asset('concave5/concave.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('concave5/js/concave.js') }}"></script>
    <script type="text/javascript" src="{{ asset('concave5/js/plugins/toast/js/jquery.toast.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->  
</head>
<body >

    <div class="login-page">
        <div class="wrapper">
             <div class="login-box">
                
                        <div >
                        @if(file_exists(public_path().'/uploads/images/'.config('concave')['cnf_logo']) && config('concave')['cnf_logo'] !='')
                        <img src="{{ asset('uploads/images/'.config('concave')['cnf_logo'])}}" alt="{{ config('concave')['cnf_appname'] }}" width="90" />
                        @else
                        <img src="{{ asset('uploads/logo.png')}}" alt="{{ config('concave')['cnf_appname'] }}" width="100" />
                        @endif
                            </div>
                        <div class="p-2"><b style="text-transform:uppercase " class="mt-2"  > {{ config('concave.cnf_appdesc') }}  </b></div>    

                    @yield('content') 
                
            </div>
        </div>    
    </div>

</body> 
</html>