<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('pageTitle')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/vendor/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/vendor/dist/css/adminlte.min.css')}}">
  @stack('css')
  <style>
    form button {
        margin-left: 50%;
        margin-bottom: 10px;
    }

    .alert .alert-danger {
        padding: 10px;
        background-color: #f89891;
        color: red;
    }
    .alert .alert-success {
        padding: 10px;
        background-color: #9ed19f;
        color: green;
    }

    table, th, td, tr {
        border: 1px solid;
        border-collapse: collapse;
    }

    /* Popup container */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

/* The actual popup (appears on top) */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class when clicking on the popup container (hide and show the popup) */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Fingent</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link {{!(request()->route()->getName()) ? 'active' : ''}}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
            </li>
          <li class="nav-item {{request()->routeIs('students.*') ? 'menu-open' : 'menu-close'}}">
            <a href="#" class="nav-link {{request()->routeIs('students.*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Student
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('students.list')}}" class="nav-link {{(request()->routeIs('students.list') || request()->routeIs('students.add') || request()->routeIs('students.edit')) ? 'active' : ''}}">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Personal Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.mark.list')}}" class="nav-link {{request()->routeIs('students.mark.*') ? 'active' : ''}}">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Mark Details</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{request()->routeIs('list.*') ? 'menu-open' : 'menu-close'}}">
            <a href="#" class="nav-link {{request()->routeIs('list.*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                List
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('list.teachers')}}" class="nav-link {{request()->routeIs('list.teachers') ? 'active' : ''}}">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Teachers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('list.subjects')}}" class="nav-link {{request()->routeIs('list.subjects') ? 'active' : ''}}">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Subjects</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">




    @yield('content')


</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- Default to the left -->
  <strong>Copyright &copy; .</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/vendor/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/vendor/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/vendor/dist/js/adminlte.min.js')}}"></script>
<script>
$(document).ready(function () {
    setTimeout(function(){
        $('.alert').hide();
    },1000);
});

</script>
@stack('js')
</body>
</html>
