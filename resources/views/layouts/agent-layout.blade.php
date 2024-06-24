<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script>
    if (sessionStorage.getItem('role') != 'agent') {
      location.href = "/notFound";
    }
  </script>

</head>

<body>

  @include('includes.agent.header')

  @include('includes.agent.sidebar')

  @yield('content')

  @include('includes.footer')


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @yield('script')

  <script>
    addEventListener('DOMContentLoaded', function(event) {
      var logoutBtn = document.querySelector('#logoutBtn');

      logoutBtn.style.cursor = 'pointer';

      logoutBtn.addEventListener('click', function(event) {
        sessionStorage.removeItem('role');
        sessionStorage.removeItem('email');
        sessionStorage.removeItem('lastName');
        sessionStorage.removeItem('firstName');
        sessionStorage.removeItem('occupation');
        sessionStorage.removeItem('profileImg');

        location.href = "/";
      });

      var userProfile = document.querySelector('#user-img');
      var userName = document.querySelector('#user-name');
      var userFullName = document.querySelector('#user-fullName');
      var userOccupation = document.querySelector('#user-occupation');

      userProfile.setAttribute('src', sessionStorage.getItem('profileImg'));

      var userFirstName = sessionStorage.getItem('firstName');
      var userLastName = sessionStorage.getItem('lastName');

      userName.innerHTML = userFirstName[0].toUpperCase() + '. ' + userLastName;

      userFullName.innerHTML = userFirstName + ' ' + userLastName;

      if (sessionStorage.getItem('occupation') == null) {
        userOccupation.innerHTML = sessionStorage.getItem('role');
      } else {
        userOccupation.innerHTML = sessionStorage.getItem('occupation');
      }

    });
  </script>

</body>

</html>