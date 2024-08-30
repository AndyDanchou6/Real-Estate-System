<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Real Estate</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/welcomePage.css') }}" rel="stylesheet">

</head>

<body>
    <div class="d-flex align-items-center w-100 bg-blue" id="header">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex align-items-center col-10 col-lg-7">
                    <a href="/">
                        <h3 class="text-white mb-0">Real Estate</h3>
                    </a>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <nav class="h-100 d-flex align-items-center justify-content-center">
                        <ul class="d-flex align-items-center mb-0">
                            <li class="px-3"><a href="/" class="text-white">Home</a></li>
                            <li class="px-3"><a href="/land" class="text-white">Land</a></li>
                            <li class="px-3"><a href="/houses" class="text-white">House</a></li>
                            <li class="px-3"><a href="/commercial" class="text-white">Commercial</a></li>
                            <li class="px-3">
                                <a href="/login" class="text-white signIn-link">Login</a>
                                <a href="" class="text-white d-none dashboard-link">Dashboard</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Menu Button -->
                <div class="col-2 d-lg-none d-flex justify-content-center">
                    <i class="bi bi-grid-fill text-light fs-3" id="sidebar-toggle"></i>
                </div>
                <!-- End of Menu Button -->
            </div>
            <div class="home-sidebar bg-light d-lg-none">
                <nav>
                    <ul class="p-0">
                        <li class="py-3"><a href="/" id="home-link">Home</a></li>
                        <li class="py-3"><a href="/land" id="land-link">Land</a></li>
                        <li class="py-3"><a href="/houses" id="house-link">House</a></li>
                        <li class="py-3"><a href="/commercial" id="commercial-link">Commercial</a></li>
                        <li class="py-3">
                            <a href="/login" class="signIn-link">Login</a>
                            <a href="" class="d-none dashboard-link">Dashboard</a>
                        </li>
                        <li class="py-3" id="home-sidebar-closeBtn"><a>Close</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div id="content">

        <!-- Contents -->
        @yield('contents')

        <!-- Footer -->
        <div class="card mt-4">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-sm-4" id="contacts">
                            <h5>For More Info</h5>
                            <ul>
                                <li><a href="">Facebook</a></li>
                                <li><a href="">Youtube</a></li>
                                <li><a href="">Instagram</a></li>
                                <li><a href="">Gmail</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-sm-4" id="contacts">
                            <h5>Talk with Devs</h5>
                            <ul>
                                <li><a href="">s.retulla@gmail.com</a></li>
                                <li><a href="">m.lina@gmail.com</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-sm-4" id="contacts">
                            <h5>FAQs</h5>
                            <ul>
                                <li><a href="">What is Real Estate?</a></li>
                                <li><a href="">Is Real Estate legit?</a></li>
                                <li><a href="">Is it responsive?</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('sweetalert/popups.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function dashboardLink() {
            const signInLink = document.querySelectorAll('.signIn-link');
            const dashboardLink = document.querySelectorAll('.dashboard-link');
            const loggedIn = sessionStorage.getItem('danchou');

            if (loggedIn) {

                signInLink.forEach(signIn => {
                    signIn.classList.add('d-none');
                })

                dashboardLink.forEach(link => {
                    link.classList.remove('d-none');
                })
            }
        }

        function redirectToDashboard() {
            var identifier = sessionStorage.getItem('nice');
            var dashboards = document.querySelectorAll('.dashboard-link');

            dashboards.forEach(dashboard => {
                if (identifier == "31C") {
                    dashboard.setAttribute('href', '/admin/dashboard');
                } else if (identifier == "07") {
                    dashboard.setAttribute('href', '/agent/dashboard');
                } else if (identifier == "3W") {
                    dashboard.setAttribute('href', '/client/dashboard');
                } else {
                    dashboard.setAttribute('href', '/');
                }
            })
        }

        const sidebarToggle = document.querySelector('#sidebar-toggle');

        sidebarToggle.addEventListener('click', function() {

            var homeSidebar = document.querySelector('.home-sidebar');

            homeSidebar.style.right = '0';
        })

        const sideBarClose = document.querySelector('#home-sidebar-closeBtn');

        sideBarClose.addEventListener('click', function() {

            var homeSidebar = document.querySelector('.home-sidebar');

            homeSidebar.style.right = '-210px';
        })

        function redirectToDetail() {

            var properties = document.querySelectorAll('.property-summary');

            properties.forEach(function(property) {
                property.addEventListener('click', function() {
                    var propertyId = property.querySelector('.property-id').textContent;

                    if (propertyId) {

                        sessionStorage.setItem('propertyId', propertyId);

                        location.href = '/property/details';
                    }
                })
            })

            setTimeout(() => {
                redirectToDetail();
            }, 2000);
        }

        redirectToDetail();
        dashboardLink();
        redirectToDashboard();
    })
</script>

</html>