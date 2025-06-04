<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta name="description" content="Login ke Website HIMATIF">
    <meta name="keywords" content="login, himatif">

    <!-- Favicons -->
    <link href="{{ asset('assets\img\data himatif\himatif.jpg') }}" rel="icon" type="image/png">
    <link href="{{ asset('assets/data himatif/logo.png') }}" rel="apple-touch-icon" type="image/png">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset('assets/img/alumni.jpg') }}');
            /* Ganti dengan path gambar Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            /* Set tinggi body menjadi 100% viewport height */
            display: flex;
            /* Menggunakan flexbox untuk centering */
            align-items: center;
            /* Vertically center */
            justify-content: center;
            /* Horizontally center */
            margin: 0;
            /* Hilangkan margin default */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            /* Latar belakang semi-transparan */
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            /* Lebar container */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2 class="text-center mb-4">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="nim" name="nim" id="nim" class="form-control" value="{{ old('nim') }}"
                    required>
            </div>


            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" id="username" class="form-control" value="{{ old('username') }}"
                    required>
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <p class="mt-3 text-center" style="color:#000000">
            Belum punya akun? <a href="{{ route('showRegister') }}">Register di sini</a>
        </p>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
