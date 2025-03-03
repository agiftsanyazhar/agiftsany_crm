<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="{{ url('https://fonts.gstatic.com') }}" rel="preconnect">
    <link href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('auth-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('auth-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('auth-assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dashboard-assets/extensions/sweetalert2/sweetalert2.min.css') }}">

    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>
</head>

<body>

    <main>
        <div class="container">
            @yield('container')
        </div>
    </main>

    <!-- Vendor JS Files -->
    <script src="{{ asset('auth-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dashboard-assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/static/js/pages/sweetalert2.js') }}"></script>

    <script>
        function alertDialog(inputName, label) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: `${label} is required`,
                confirmButtonColor: '#152d8f',
                confirmButtonText: 'Close',
            });
        }
    </script>

</body>

</html>
