
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>SIP CAPDA</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{asset('buleleng.png')}}" class="img-responsive"widht="100" height="100" type="image/x-icon"> <!-- [Google Font] Family -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="{{ asset('template/dist')}}/assets/fonts/tabler-icons.min.css" >
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="{{ asset('template/dist')}}/assets/fonts/feather.css" >
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="{{ asset('template/dist')}}/assets/fonts/fontawesome.css" >
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="{{ asset('template/dist')}}/assets/fonts/material.css" >
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('template/dist')}}/assets/css/style.css" id="main-style-link" >


  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  @vite(['resources/js/app.js'])

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
  <nav class="pc-sidebar">
      <div class="m-header">
        <a href="../dashboard/index.html" class="b-brand d-flex align-items-center text-decoration-none">
          <!-- Logo -->
          <img src="{{ asset('dishub.png') }}" alt="logo" width="60" height="40" class="me-2">

          <!-- Tulisan -->
          <span class="brand-text">SIP CAPDA</span>
        </a>
      </div>
      <div class="navbar-content">
        <ul class="pc-navbar">
          <li class="pc-item">
            <a href="/home" class="pc-link">
              <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
              <span class="pc-mtext">Dashboard</span>
            </a>
          </li>
          <li class="pc-item pc-caption">
            <label>APP</label>
            <i class="ti ti-dashboard"></i>
          </li>
          @if(Auth::user()->role->role_name == 'admin')
          <li class="pc-item pc-hasmenu">
            <a href="{{ route('users.index') }}" class="pc-link"><span class="pc-micon"><i class="ti ti-user"></i></span><span class="pc-mtext">Data User</span><span class="pc-arrow"></span></a>
          </li>
          @endif
          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-file-analytics"></i></span><span class="pc-mtext">Data Rencana</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="{{ route('bidang.index') }}">Data Bagian</a></li>
              <li class="pc-item"><a class="pc-link" href="{{ route('program.index') }}">Data Program</a></li>
              <li class="pc-item"><a class="pc-link" href="{{ route('kegiatan.index') }}">Data Kegiatan</a></li>
              <li class="pc-item"><a class="pc-link" href="{{ route('subkegiatan.index') }}">Data Sub Kegiatan</a></li>
            </ul>
          </li>
          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-checkbox"></i></span><span class="pc-mtext">Data Realisasi</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="{{route('laporan.index')}}">Input Data Realisasi</a></li>
            
            </ul>
          </li>
          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-chart-bar"></i></span><span class="pc-mtext">Data Total Capaian</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="{{route('totallaporan.index')}}">Input Data Laporan Per - Bulan</a></li>

            </ul>
          </li>

          <li class="pc-item pc-caption">
            <label>Laporan</label>
            <i class="ti ti-news"></i>
          </li>
          <li class="pc-item">
            <a href="/table-print" class="pc-link">
              <span class="pc-micon"><i class="ti ti-printer"></i></span>
              <span class="pc-mtext">Print Document</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <!-- ======= Menu collapse Icon ===== -->
        <li class="pc-h-item pc-sidebar-collapse">
          <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="dropdown pc-h-item d-inline-flex d-md-none">
          <a
            class="pc-head-link dropdown-toggle arrow-none m-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
          >
            <i class="ti ti-search"></i>
          </a>
          <div class="dropdown-menu pc-h-dropdown drp-search">
            <form class="px-3">
              <div class="form-group mb-0 d-flex align-items-center">
                <i data-feather="search"></i>
                <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
              </div>
            </form>
          </div>
        </li>
       
      </ul>
    </div>
<!-- [Mobile Media Block end] -->
    <div class="ms-auto">
      <ul class="list-unstyled">
        <li class="dropdown pc-h-item">
          <a
            class="pc-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            aria-expanded="false"
          >
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Status : {{ Auth::user()->role?->role_name }}</a>
          </a>
        </li>
        <li class="dropdown pc-h-item header-user-profile">
        <a
            class="pc-head-link dropdown-toggle arrow-none me-0"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="false"
            data-bs-auto-close="outside"
            aria-expanded="false"
          >
          <img src="{{ asset('template/dist')}}/assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
          <span></span>
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header">
              <div class="d-flex mb-1">
                <div class="flex-shrink-0">
                  <img src="{{ asset('template/dist')}}/assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">{{auth()->user()->name}}</h6>
                  <span>Staf Dishub</span>
                </div>
                <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-power text-danger"></i></a>
              </div>
            </div>
            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active"
                  id="drp-t1"
                  data-bs-toggle="tab"
                  data-bs-target="#drp-tab-1"
                  type="button"
                  role="tab"
                  aria-controls="drp-tab-1"
                  aria-selected="true"
                  ><i class="ti ti-user"></i> Profile</button
                >
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="drp-t2"
                  data-bs-toggle="tab"
                  data-bs-target="#drp-tab-2"
                  type="button"
                  role="tab"
                  aria-controls="drp-tab-2"
                  aria-selected="false"
                  ><i class="ti ti-settings"></i> Setting</button
                >
              </li>
            </ul>
            <div class="tab-content" id="mysrpTabContent">
              <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-edit-circle"></i>
                  <span>Edit Profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-user"></i>
                  <span>View Profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-power text-danger"></i>
                  <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <span>Logout</span>
                    </button>
                  </form>
                </a>
              </div>
              <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">   
                <a href="#!" class="dropdown-item">
                  <i class="ti ti-user"></i>
                  <span>Account Settings</span>
                </a>   
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
 </div>
</header>
<!-- [ Header ] end -->
  <!-- [ Main Content ] start -->
 
  <div class="pc-container">
    <div class="pc-content">
        
        @yield('content')

    </div>
  </div>
  
  <footer class="pc-footer bg-light border-top mt-4 py-4 shadow-sm">
    <div class="container text-center">

      <!-- Logo + Nama Dishub -->
      <div class="d-flex justify-content-center align-items-center gap-3 mb-2 flex-wrap">
        <img src="{{ asset('dishub.png') }}" 
            alt="Logo Dishub" 
            width="60" 
            height="45" 
            class="rounded-circle shadow-sm">
        <h5 class="m-0 fw-semibold text-primary footer-title">
          Dinas Perhubungan Kabupaten Buleleng
        </h5>
      </div>

      <!-- Info Kontak -->
      <div class="contact-info text-muted small mb-2">
        <i class="bi bi-telephone text-primary me-1"></i> 
        <span>(0362) 21684</span> &nbsp; | &nbsp;
        <i class="bi bi-envelope text-primary me-1"></i> 
        <a href="mailto:dishub@bulelengkab.go.id" class="text-decoration-none text-dark">
          dishub@bulelengkab.go.id
        </a>
      </div>

      <!-- Teks Crafted -->
      <div class="text-muted small">
        <span>Crafted with @ by</span>
        <a href="#" target="_blank" class="footer-link fw-semibold text-dark text-decoration-none ms-1">
          Ngurah Dewa
        </a>
      </div>

      <!-- Garis & link website -->
      <div class="mt-2">
        <a href="https://dishub.bulelengkab.go.id/" 
          target="_blank" 
          class="footer-site text-decoration-none d-inline-block mt-2">
          🌐 dishub.bulelengkab.go.id
        </a>
      </div>
    </div>
  </footer>
    

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>   
  <script>
    $(document).ready(function (){
        let table = new DataTable('#table');
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- [Page Specific JS] start -->
  <script src="{{ asset('template/dist')}}/assets/js/plugins/apexcharts.min.js"></script>
  <script src="{{ asset('template/dist')}}/assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
  <script src="{{ asset('template/dist')}}/assets/js/plugins/popper.min.js"></script>
  <script src="{{ asset('template/dist')}}/assets/js/plugins/simplebar.min.js"></script>
  <script src="{{ asset('template/dist')}}/assets/js/plugins/bootstrap.min.js"></script>
  <script src="{{ asset('template/dist')}}/assets/js/fonts/custom-font.js"></script>
  <script src="{{ asset('template/dist')}}/assets/js/pcoded.js"></script>
  <script src="{{ asset('template/dist')}}/assets/js/plugins/feather.min.js"></script>

  <script>layout_change('light');</script>
  <script>change_box_container('false');</script>
  <script>layout_rtl_change('false');</script>
  <script>preset_change("preset-1");</script>
  <script>font_change("Public-Sans");</script>
  

  <script>
    $(document).ready(function(){
        $('#tanggal').datepicker({
            format: 'yyyy-mm-dd',     // format sesuai MySQL
            autoclose: true,
            todayHighlight: true
        });
    });
  </script>
   

  @include('sweetalert::alert') 

</body>
<!-- [Body] end -->

</html>