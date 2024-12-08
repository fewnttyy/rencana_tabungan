<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}">
    <link href="assets/css/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <title>AtasiSite! - @yield('judulpage')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <section id="sidebar">
        <a href="" class="brand"><img src="{{asset('img/logo.png')}}" alt="" style="width: 37px; height: 30px; margin-left: 10px; margin-right: 15px;"> AtasiSite!</a>
        <ul class="side-menu">
            <li><a href="/super_admin" class="active"><i class="bx bxs-dashboard icon"></i> Dashboard</a></li>
            <li class="devider" data-text="main">Main</li>
            <li>
                <a href="#"><i class="bx bxs-inbox icon"></i> Data Pengguna <i class="bx bx-chevron-right icon-right"></i></a>
                <ul class="side-dropdown">
                    <li><a href="#">Admin Keuangan</a></li>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Teller</a></li>
                    <li><a href="#">Nasabah</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="bx bxs-inbox icon"></i> Transaksi <i class="bx bx-chevron-right icon-right"></i></a>
                <ul class="side-dropdown">
                    <li><a href="{{ route('super_admin.nabung') }}">Nabung</a></li>
                    <li><a href="{{ route('super_admin.tarikSaldo') }}">Tarik Saldo</a></li>
                    <li><a href="{{ route('super_admin.tutupBuku') }}">Tutup Buku</a></li>
                </ul>
            </li>
            <li class="devider" data-text="others">Others</li>
            <li><a href="{{ route('super_admin.record_data') }}"><i class="bx bxs-chart icon"></i>Report Data</a></li>
            <li>
                <a href="#"><i class="bx bxs-inbox icon"></i> History <i class="bx bx-chevron-right icon-right"></i></a>
                <ul class="side-dropdown">
                    <li><a href="{{ route('super_admin.login_history') }}">Login & Logout</a></li>
                    <li><a href="{{ route('super_admin.status_history') }}">Status Akun</a></li>
                    <li><a href="{{ route('super_admin.status_nasabah') }}">Status Nasabah</a></li>
                </ul>
            </li>
        </ul>
    </section>
    @include('topbar')
    @include('main')

    
    <script src="{{asset('js/script.js')}}"></script>

    
</body>
</html>