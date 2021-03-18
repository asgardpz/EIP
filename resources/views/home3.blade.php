<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EIP-首頁 | 訂餐系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!--home-->
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="font-size:18px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a href="" class="nav-link">  </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="font-size:18px;" ></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item d-none d-sm-inline-block">
        <a href="index2" class="nav-link" style="font-size:18px;">公司訂餐</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3" class="nav-link" style="font-size:18px;">自付訂餐</a>
      </li>      
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt" style="font-size:18px;"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">  </a>
      </li>      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="font-size:18px;">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="home" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-close">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fas fa-utensils"></i>
                  <p>
                    訂餐系統
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index2" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>公司訂餐</p>
                    </a>
                                                       
                  </li>
                </ul>                
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index3" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>自付訂餐</p>
                    </a>
                  </li>
                </ul>
              </li>
            @if ( Auth::user()->authority =='admin')  
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  會員管理
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="user" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>帳號維護</p>
                   </a>
                </li>
                <li class="nav-item">
                  <a href="pw" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>重設密碼</p>
                   </a>
                </li>                
              </ul>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="far fa-times-circle nav-icon"></i>
                <p>登出</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>              
            </li>
        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
