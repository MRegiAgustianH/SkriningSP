<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pakar Diagnosa Awal Penyakit Jantung</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo-awal.png') }}" type="image/x-icon">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
   
                        <img src="{{ asset('assets/images/SkriningApp.png') }}" alt="Logo" width="100%">
 
        <div class="card">
            <div class="card-body login-card-body">

                <div class="row">
                    <!-- <div class="col-md-6 p-4">
                        <img src="{{ asset('assets/images/logo-awal.png') }}" alt="Logo" width="100%">
                    </div> -->
                    <div class="col-md-6 py-4 m-auto">
                        <div class="login-logo mb-4">
                            <a href="#"><b>LOGIN</b></a>
                        </div>
                        @if (session()->has('error'))
                            <div class="text-center">
                                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control" required placeholder="Username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" required class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                                </div>
                                <!-- <div class="col-12 mb-4">
                                    <hr>
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-block"><i class="fa fa-arrow-left"></i> Kembali Ke Halaman Utama</a>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
</body>

</html>
