<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Multi Auth Guard') }}</title>

    <!-- Styles -->
   <!--  <link href="{{ asset('/public/css/app.css') }}" rel="stylesheet"> -->
    <!-- lte theme -->
    <link href="{{ asset('/public/ltetheme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/ltetheme/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/ltetheme/bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/ltetheme/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/ltetheme/plugins/iCheck/square/blue.css') }}" rel="stylesheet">
    <?php if(@Auth::check()){ ?>
    <link rel="stylesheet" href="{{ asset('/public/ltetheme/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <?php } ?>
    <link href="{{ asset('/public/css/admin.css') }}" rel="stylesheet">
      <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- <script src="{{ asset('/public/ltetheme/bower_components/jquery/dist/jquery.min.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<?php 
    $class = "hold-transition login-page";
    if(@Auth::check()){
        $class = "hold-transition skin-blue sidebar-mini";
    }
?>
<body class="{{ $class }}">
    <?php if(@Auth::check()){  ?>
    <div class="wrapper">
        @include('admin.layout.authheader')
        @include('admin.layout.authnavigation')
        @yield('content')
        @include('admin.layout.authfooter')
    </div>
    <?php }else{ ?>
        @yield('content')
    <?php } ?>
    
   
    <!-- Scripts -->
   
    <script src="{{ asset('/public/ltetheme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/public/ltetheme/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' /* optional */
        });
      });
    </script>
    <?php if(@Auth::check()){ ?>
    <!-- FastClick -->
    <script src="{{ asset('/public/ltetheme/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/public/ltetheme/dist/js/adminlte.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/public/ltetheme/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap  -->
    <script src="{{ asset('/public/ltetheme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('/public/ltetheme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('/public/ltetheme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/public/ltetheme/bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/public/ltetheme/dist/js/pages/dashboard2.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/public/ltetheme/dist/js/demo.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="{{ asset('/public/js/pages/aboutus.js') }}"></script>
    <!-- refer from http://www.formvalidator.net/ -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script type="text/javascript">
         $.validate({
                lang: 'en'
              });
    </script>
   <!--  <script src="{{ asset('public/assets/js/AdminLTE/app.js') }}" type="text/javascript"></script> -->
    <?php } ?>
    <!-- default js   <script src="{{ asset('/public/js/app.js') }}"></script> -->
    @yield('myjsfile')
</body>
</html>
