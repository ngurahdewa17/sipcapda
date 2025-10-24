
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Login</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{asset('buleleng.png')}}" type="image/x-icon"> <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="{{asset('template/dist')}}/assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="{{asset('template/dist')}}/assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{asset('template/dist')}}/assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{asset('template/dist')}}/assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{asset('template/dist')}}/assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="{{asset('template/dist')}}/assets/css/style-preset.css" >
@vite('resources/js/app.js')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
 <style>
  body {
  background: url('latar.jpg'),
              linear-gradient(135deg, #002855 0%, #004aad 80%);
  background-size: cover;
  background-attachment: fixed;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  position: relative;
  overflow-x: hidden;
}

.logo-title {
  display: flex;
  align-items: center;
  text-decoration: none;
  gap: 10px;
}

.logo-title img {
  width: 50px;
  height: 50px;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.logo-title img:hover {
  transform: scale(1.1);
}

.logo-text {
  font-family: 'Poppins', sans-serif;
  font-size: 1.3rem;
  font-weight: 700;
  color: #007bff;
  letter-spacing: 1px;
  text-transform: uppercase;
  position: relative;
}

/* Efek gradasi dan animasi halus */
.logo-text span {
  background: linear-gradient(90deg, #0056b3, #00b4d8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: 800;
}

/* Efek glow halus di hover */
.logo-title:hover .logo-text {
  text-shadow: 0 0 10px rgba(0, 136, 255, 0.4);
}

/* ====== LOGO CONTAINER ====== */
.logo-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 25px; /* jarak antar logo */
  margin-bottom: 15px;
}

/* ====== LOGO STYLE (BESAR & RAPI SAMA) ====== */
.logo-container img {
  width: 80px;          /* ubah angka ini jika ingin lebih besar/kecil */
  height: 80px;
  object-fit: contain;  /* pastikan proporsional */
  background: transparent;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Efek hover lembut */
.logo-container img:hover {
  transform: scale(1.1);
  box-shadow: 0 0 15px rgba(0, 102, 255, 0.3);
}

.logo-container .logo-left {
  transform: scale(1.15);
  width: 100px;          /* ubah angka ini jika ingin lebih besar/kecil */
  height: 80px; /* sedikit diperbesar */
}
.logo-container .logo-right {
  transform: scale(1.15);
  width: 50px;          /* ubah angka ini jika ingin lebih besar/kecil */
  height: 40x; /* sedikit diperbesar */
}

.header-logo {
  display: flex;
  align-items: center;
  justify-content: space-between; /* kiri-kanan */
  width: 100%;
  max-width: 800px;     /* agar tetap seimbang di layar besar */
  margin: 0 auto 30px;  /* center di halaman dan beri jarak bawah */
  padding: 0 40px;
}

/* ===== HEADER WRAPPER ===== */
.header-container {
  position: absolute;     /* tetap di atas */
  top: 20px;
  left: 0;
  right: 0;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;  /* logo kiri & kanan */
  padding: 0 40px;
  z-index: 10;
}

/* ===== LOGO STYLE ===== */
.header-container img {
  height: 80px;             /* ukuran sama */
  width: auto;
  object-fit: contain;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* efek hover logo */
.header-container img:hover {
  transform: scale(1.1);
  box-shadow: 0 0 10px rgba(13, 110, 253, 0.4);
}

/* ===== TITLE STYLE ===== */
.header-title {
  font-size: 2rem;
  font-weight: 800;
  color: #004aad;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-align: center;
  flex-grow: 1;
}

/* warna berbeda untuk kata CAPDA */
.header-title span {
  color: #0096ff;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .header-container {
    flex-direction: column;
    justify-content: center;
    gap: 10px;
    padding: 10px;
    text-align: center;
  }

  .header-container img {
    height: 60px;
  }

  .header-title {
    font-size: 1.5rem;
  }
}
 </style>

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
        <a class="thumbnail logo-title" href="#">
          <div class="header-container">
            <img class="logo-left" src="{{ asset('dishub.png') }}" alt="Logo Dishub">
            <h1 class="header-title">SIP <span>CAPDA</span></h1>
            <img class="logo-right" src="{{ asset('buleleng.png') }}" alt="Logo Kabupaten Buleleng">
          </div>
        </a>
      </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="text-center mb-4">
              <h3 class="fw-bold text-primary mb-1"><b>LOGIN</b></h3>
              <p class="text-muted small">SISTEM INFORMASI PELAPORAN CAPAIAN PELAKSANAAN PROGRAM PERANGKAT DAERAH</p>
             
            </div>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" autocomplete="off">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form> 
            <div class="saprator mt-3">
              <span>SIP CAPDA</span>
            </div>
          
          </div>
        </div>
       
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="{{asset('template/dist')}}/assets/js/plugins/popper.min.js"></script>
  <script src="{{asset('template/dist')}}/assets/js/plugins/simplebar.min.js"></script>
  <script src="{{asset('template/dist')}}/assets/js/plugins/bootstrap.min.js"></script>
  <script src="{{asset('template/dist')}}/assets/js/fonts/custom-font.js"></script>
  <script src="{{asset('template/dist')}}/assets/js/pcoded.js"></script>
  <script src="{{asset('template/dist')}}/assets/js/plugins/feather.min.js"></script>

  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  
    
 
</body>
<!-- [Body] end -->

</html>
