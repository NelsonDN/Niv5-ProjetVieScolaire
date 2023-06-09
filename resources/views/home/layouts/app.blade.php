<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{ asset('assetshome/img/logo1.png') }}" rel="icon">
  <link href="{{ asset('assetshome/img/logo1.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('assetshome/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Liibraries CSS Files -->
  <link href="{{ asset('assetshome/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetshome/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetshome/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetshome/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetshome/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('assetshome/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assetshome/css/scss-files.scss') }}" rel="stylesheet">


  <!-- =======================================================
    Theme Name: Rapid
    Theme URL: https://bootstrapmade.com/rapid-multipurpose-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>


  @include('home.layouts.header')

  @yield('content')

  @include('home.layouts.footer')

</body>
</html>
