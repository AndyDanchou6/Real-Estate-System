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

    let [role, index] = identifier.split('_');

    if (role != '31C') {
      location.href = "/notFound";
    }
  </script>

</head>

<body>

  @include('includes.admin.header')

  @include('includes.admin.sidebar')

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
    async function fetchApi(url, method = 'GET', headers = {}, data = null) {
      try {
        const fetchOptions = {
          method: method.toUpperCase(),
          headers: headers,
        };

        if (method.toUpperCase() !== 'GET' && data) {
          fetchOptions.body = JSON.stringify(data);
        }

        const response = await fetch(url, fetchOptions);
        const responseData = await response.json();

        if (response.ok) {
          return responseData;
        } else {
          throw new Error(`Request failed with status ${response.status}: ${responseData.message}`);
        }
      } catch (error) {
        console.error('Fetch error:', error);
        throw error;
      }
    }

    addEventListener('DOMContentLoaded', function(event) {
      async function performLogout() {
        try {
          var token = sessionStorage.getItem('danchou');
          var roleId = sessionStorage.getItem('nice');
          let [role, id] = roleId.split('_');
          const logoutApi = '/api/logout';
          var method = 'POST';
          var headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + token
          };
          const data = {
            id: id
          };

          const response = await fetchApi(logoutApi, method, headers, data);

          console.log('Logout response:', response.status);

          sessionStorage.removeItem('danchou');
          sessionStorage.removeItem('nice');

          window.location.href = '/';

        } catch (error) {
          alert('Logout error: ', error.message);
        }
      }

      var logoutBtn = document.querySelector('#logoutBtn');

      logoutBtn.style.cursor = 'pointer';

      logoutBtn.addEventListener('click', function(event) {

        performLogout();
      });

    });
  </script>

</body>

</html>