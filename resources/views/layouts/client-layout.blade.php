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
    var identifier = sessionStorage.getItem('nice');
    if (!identifier) {
      location.href = "/notFound";
    }

    if (identifier != '3W') {
      location.href = "/notFound";
    }
  </script>

</head>

<body>

  @include('includes.client.header')

  @include('includes.client.sidebar')

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
    
  <script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('sweetalert/popups.js') }}"></script>

  @yield('script')

  <script>
    // Utility functions
    function displayUserData(userData) {
      var userImage = document.querySelector('#user-img');
      var userName = document.querySelector('#user-name');
      var userFullName = document.querySelector('#user-fullName');
      var userOccupation = document.querySelector('#user-occupation');

      if (!userData.profileImg) {

        userImage.setAttribute('src', '/avatar/user-avatar1.jpeg');

      } else {

        userImage.setAttribute('src', userData.profileImg);
      }

      userName.innerHTML = userData.firstName[0].toUpperCase() + '.' + ' ' + userData.lastName;
      userFullName.innerHTML = userData.firstName + ' ' + userData.lastName;

      if (!userData.occupation) {

        userOccupation.innerHTML = userData.role;
      } else {

        userOccupation.innerHTML = userData.occupation;
      }
    }

    // When page is fully loaded
    addEventListener('DOMContentLoaded', function(event) {
      var token = sessionStorage.getItem('danchou');

      // Async functions
      async function fetchUserData() {
        try {
          const userDataApi = '/api/users/loggedInUserData';

          var additionalParameters = {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'Authorization': 'Bearer ' + token
            }
          }

          const response = await fetch(userDataApi, additionalParameters);

          if (response.status == 200) {
            var data = await response.json();

            if (data) {

              displayUserData(data.data);
            }
          }

        } catch (error) {
          console.log('Error fetching user data', error.message)
        }
      }

      async function performLogout() {
        try {
          const logoutApi = '/api/logout';
          var additionalParameters = {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'Authorization': 'Bearer ' + token
            }
          };

          const response = await fetch(logoutApi, additionalParameters);

          if (response.status == 200) {
            sessionStorage.removeItem('danchou');
            sessionStorage.removeItem('nice');

            window.location.href = '/';
          } else {
            alert('Logout Failed');
          }

        } catch (error) {
          alert('Logout error: ', error.message);
        }
      }

      // Main functions
      fetchUserData();

      var logoutBtn = document.querySelector('#logoutBtn');

      logoutBtn.style.cursor = 'pointer';

      logoutBtn.addEventListener('click', function(event) {

        performLogout();
      });

    });
  </script>

</body>

</html>