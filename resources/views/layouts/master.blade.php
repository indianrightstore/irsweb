<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="{{ asset('resources/assets/backend/dist/img/logo.png')}}" type="image/gif" sizes="16x16">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bestway</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/jqvmap/jqvmap.min.css')}}"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}"> -->
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/summernote/summernote-bs4.css')}}"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="{{ asset('resources/assets/backend/css/custom.css')}}">
   <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('resources/assets/backend/plugins/toastr/toastr.min.css')}}">
  <!-- active button -->
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  @stack('css')
</head> 
@include('navbar')
@include('sidebar')
<div class="content-wrapper">
 
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <!--main content will show hare---->
              @yield('content') 
            <!--main content will show hare---->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



</div>  
<!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright Bestway.com All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        
        </div>
    </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('resources/assets/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('resources/assets/backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('resources/assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Sparkline -->
<!-- <script src="{{ asset('resources/assets/backend/plugins/sparklines/sparkline.js')}}"></script> -->
<!-- JQVMap -->
<!-- <script src="{{ asset('resources/assets/backend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('resources/assets/backend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="{{ asset('resources/assets/backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script> -->
<!-- daterangepicker -->
<script src="{{ asset('resources/assets/backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('resources/assets/backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('resources/assets/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<!-- <script src="{{ asset('resources/assets/backend/plugins/summernote/summernote-bs4.min.js')}}"></script> -->
<!-- overlayScrollbars -->
<!-- <script src="{{ asset('resources/assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script> -->
<!-- AdminLTE App -->
<script src="{{ asset('resources/assets/backend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('resources/assets/backend/dist/js/pages/dashboard.js')}}"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('resources/assets/backend/dist/js/demo.js')}}"></script> -->
<script src="{{ asset('resources/assets/backend/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('resources/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('resources/assets/backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{ asset('resources/assets/backend/plugins/toastr/toastr.min.js')}}"></script>
<!-- <script src="{{ asset('resources/assets/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script> -->
<!-- active button -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
function goBack() {
  window.history.back();
}
</script>
@stack('js')
</body>
</html>
   