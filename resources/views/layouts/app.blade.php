<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> {{ config('concave.cnf_appname')}} </title>

<link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/png">

<link href="{{ asset('concave5/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('concave5/concave.min.css')}}" rel="stylesheet">
<link href="{{ asset('concave5/css/core.css')}}" rel="stylesheet">
<link href="{{ asset('concave5/css/theme.css')}}" rel="stylesheet">

<link href="{{ asset('concave5/js/plugins/toast/css/jquery.toast.css')}}" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<!-- FONT -->
<link href="{{ asset('concave5/fonts/icomoon.css')}}" rel="stylesheet">
<link href="{{ asset('concave5/fonts/lineicons/LineIcons.min.css')}}" rel="stylesheet">
<link href="{{ asset('concave5/fonts/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{ asset('concave5/js/plugins/iCheck/skins/flat/blue.css')}}" rel="stylesheet">
<link href="{{ asset('concave5/js/plugins/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

<script type="text/javascript" src="{{ asset('concave5/concave.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('concave5/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('concave5/js/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="{{ asset('concave5/js/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('concave5/js/plugins/node-waves/waves.js') }}"></script>
<script type="text/javascript" src="{{ asset('concave5/js/concave.js') }}"></script>

<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->         


</head>
<body >
<div id="preloader"></div>
  <div id="app" class="page-wrapper">
        @include('layouts.navigation')
		@if(\Auth::user()->temp_pass == '0')
		<p class="text-center alert alert-danger rounded-0 mb-0">Your password is not secure! It's mendatory to change your password after first login. You can not reuse your current pasword for future login access.</p>
		@endif		
        <main class="page-content" > 
        <a href="javascript:;" class="toggleMenu flying-button"  ><i class="lni-menu"></i></a>      
            <div class="page-inner">
            <div class="ajaxLoading"></div>   
            @yield('content')
            </div>  
        </main>
        
  </div>

@if(\Auth::user()->group_id == 5)<style>.hide_on_agent{display:none}</style> @endif

<div class="modal " id="concave-modal" role="dialog" aria-hidden="true" tabindex="-1"  >
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"  id="concave-modal-content">
           
          </div>
          
        </div>
    </div>
</div>

{{ SiteHelpers::showNotification() }} 

@if(\Auth::user()->group_id == 7 )
<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5f52bcb9f0e7167d000d934e/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->

@endif

<script>
  jQuery(document).ready( function () {
    jQuery('.data_table').DataTable();
    
} );
</script>

</body>
</html>
