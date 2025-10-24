<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIP CAPDA') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Pastikan body memenuhi tinggi layar */
        html, body {
            height: 100%;
        }
        /* Pusatkan isi dengan flexbox */
        #app {
            min-height: 100vh;
            display: flex;
            align-items: center;   /* Vertikal */
            justify-content: center; /* Horizontal */
            background-color: #f8f9fa; /* opsional, biar rapi */
        }

        .content-wrapper {
            width: 100%;
            max-width: 800px; /* Batas lebar konten */
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success text-center" id="success-alert" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>