<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale() == 'ar') dir="rtl" class="rtl" @endif>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Accueil - ISPLTI</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('logo.jpeg') }}" rel="icon">
  <link href="{{ asset('logo.jpeg') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets-lib/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets-lib/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets-lib/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets-lib/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets-lib/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets-lib/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceSchool
  * Template URL: https://bootstrapmade.com/nice-school-bootstrap-education-template/
  * Updated: May 10 2025 with Bootstrap v5.3.6
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
    .link-disabled {
    pointer-events: none;   /* ignore les clics */
    color: #888;            /* style visuel de disabled */
    text-decoration: none;
    }
    </style>
</head>
 <body class="index-page @if(app()->getLocale() == 'ar') rtl-body @endif">
   {{-- header --}}
   @include('layouts_site.header')
   <!-- Scroll Top -->
   <main id="main">
        @yield('content')
    </main><!-- End #main -->

    {{-- footer --}}

   {{-- main content --}}

   {{-- footer --}}
   @include('layouts_site.footer')
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets-lib/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets-lib/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets-lib/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets-lib/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets-lib/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets-lib/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets-lib/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets-lib/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets-lib/js/main.js') }}"></script>
</body>
