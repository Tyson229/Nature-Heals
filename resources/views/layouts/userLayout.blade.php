<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> {{ config('app.name') }} </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="/css/styles.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/js/scripts.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>

        <!--CSS-->
        @yield('style')
        <!--CSS-->
        
    </head>
    <body class="d-flex flex-column min-vh-100 bg-light">
        
        <!--Nav Bar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <h1 style="font-family:serif;" >Nature Heals</h1>
                </a>
                <ul class="navbar-nav nav ms-auto">
                    @yield('nav-bar')
                </ul>
            </div>
        </nav>
        <!--Nav Bar-->
        
        <!--Content-->
        @yield('content')
        <!--Content-->

        <!--Footer-->                        
        <div class="footer bg-dark p-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 text-white">
                        <h4 class="footer-title"> Quick Links</h4>
                        <a href="/" class="nav-link text-white">Home</a>
                        <a href="/tools" class="nav-link text-white">Tools</a>
                        <a href="/contact" class="nav-link text-white">Contact Us</a>
                        <a href="/request" class="nav-link text-white">Request</a>
                    </div>
                    <div class="col-sm-4 text-white">
                        <h4 class="footer-title"> Contact</h4>
                        <p>Address: Western Sydney University</p>
                        <p>Email: Info@natureheals.com.au</p>
                        <p>Phone: 000-0000</p>
                    </div>
                    <div class="col-sm-5 ">
                        <img src="/pictures/wsu-shield.jpg" class="logo float-end border rounded-3">
                    </div>
                </div>
                <div class="footer-copyright text-center">© 2021 Copyright: Nature Heals </div>
                
            </div>
        </div>
        <!--Footer-->
    </body>    
</html>
@yield('script')