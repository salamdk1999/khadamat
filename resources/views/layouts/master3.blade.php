<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>KHADAMAT</title>
<meta content="" name="description">
<meta content="" name="keywords">

{{-- websocket --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{--  --}}

<!-- Favicons -->
{{-- <link href="assets2/img/favicon.png" rel="icon"> --}}
<link href="assets2/img/logo.png" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ URL::asset('assets2/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets2/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets2/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets2/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets2/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets2/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ URL::asset('assets2/css/style.css')}}" rel="stylesheet">

{{-- notify --}}
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
{{--  --}}


</head>
<body>
    <div id="app">
        @include('include.header')
        @include('include.hero_section')
        @include('include.about_section')
        @include('include.portfolio_section')
        @yield('content')
        @include('include.hero_container')
        @include('include.footer')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </div>

<!-- Vendor JS Files -->
<script src="{{ URL::asset('assets2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets2/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{ URL::asset('assets2/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{ URL::asset('assets2/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets2/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="assets2/js/main.js"></script>
{{--مشان ضمن الفيو --}}
<script src=" {{URL::asset('js/app.js')}}"></script>

</body>

</html>

