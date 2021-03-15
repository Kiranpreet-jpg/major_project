<!-- Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>Campus Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Skill Point Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('web/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <!-- login icon animation -->
    <link href="{{ asset('web/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <!-- Custom CSS -->
    <link href="{{asset('web/css/style.css')}}" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="{{asset('web/css/fontawesome-all.min.css')}}" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400i,700i" rel="stylesheet">
    <!--//online fonts -->
</head>

<body>
    <div class="se-pre-con"></div>
    <!-- header -->
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="d-flex header-agile">
                            <li>
                                <span class="fas fa-envelope-open"></span>
                                <a href="mailto:example@email.com" class="text-white">info@example.com</a>
                            </li>
                            <li>
                                <span class="fas fa-phone-volume"></span>
                                <p class="d-inline text-white">+456 123 7890</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 hearder-right-agile">
                        <div class="d-flex">
                            <!-- Multiple select filter -->
                            <select class="custom-select">
                                <option value="HTML">Programming</option>
                                <option value="jQuery">Art & Design</option>
                                <option value="Pug">Languages</option>
                                <option value="SASS">UX Training</option>
                                <option value="Angular">Business</option>
                                <option value="React">Vocabulary</option>
                                <option value="Jade">Photography</option>
                                <option value="PHP">Inclusive-education</option>
                                <option value="Java">New Technologies</option>
                            </select>
                            <!-- Multiple select filter  -->
                            <div class="login-wthree my-auto">
                                <a href="{{ route('web.login') }}" class="text-white text-capitalize">login <span class="fas fa-sign-in-alt flash animated infinite"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light p-0 d-flex justify-content-center">
                    <h1><a class="navbar-brand" href="{{ route('web.home') }}">
                    <span>C</span>ampus
                            <i class="w3-spacing" style="margin-right: 0rem;"></i>
                            <span>M</span>anagement
                            <i class="w3-spacing" style="margin-right: 0rem;"></i>
                            <span>S</span>ystem
                            <i class="w3-spacing" style="margin-right: 0rem;"></i>
                        </a></h1>
                </nav>
            </div>
        </div>
    </header>
    <!-- //header -->
    <!-- banner -->
    <!-- Carousel -->
    <div class="row justify-content-center align-items-center no-gutters banner-agile">
        <div class="col-lg-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item bg1 active">
                        <div class="bnr-text-wthree">
                            {{-- <h3 class="b-w3ltxt">the perfect theme for</h3>
                            <p class="mx-auto text-capitalize mt-2 text-white">education and training center</p> --}}
                        </div>
                    </div>
                    <!-- slider text -->
                    <div class="carousel-item bg2">
                        <div class="bnr-text-wthree">
                            {{-- <h3 class="b-w3ltxt">the perfect theme for</h3>
                            <p class="mx-auto text-capitalize mt-2 text-white">education and training center</p> --}}
                        </div>
                    </div>
                    <!-- slider text -->
                    <div class="carousel-item bg3">
                        <div class="bnr-text-wthree">
                            {{-- <h3 class="b-w3ltxt">the perfect theme for</h3>
                            <p class="mx-auto text-capitalize mt-2 text-white">education and training center</p> --}}
                        </div>
                    </div>
                    <!-- slider text -->
                </div>
            </div>
            <!-- Carousel -->
            <!-- //banner -->
        </div>
        <div class="col-lg-4">
            <div class="wthree-form">
                <h4>Login to your account</h4>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger
                 alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="{{route('web.logincheck')}}" method="post" class="register-wthree">
                @csrf
                <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="fas fa-envelope-open"></span>
                                <label>
                                    Email
                                </label>
                                <input class="form-control" type="email" placeholder="example@email.com" name="email"
                                    required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="fas fa-lock"></span>
                                <label>
                                    password
                                </label>
                                <input type="password" class="form-control" placeholder="*******" name="password" id="password1"
                                    required="">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-agile btn-block w-100">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- //carousel -->
    <!-- //banner -->
    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my-lg-auto mt-3">
                    <div class="cpy-right text-lg-right text-center">
                        <p class="text-secondary">© All rights reserved </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //footer -->
    <!-- js-->
    <script src="{{asset('web/js/jquery-2.2.3.min.js')}}"></script>
    <!-- loading-gif Js -->
    <script src="{{asset('web/js/modernizr.js')}}"></script>
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    <!--// loading-gif Js -->
    <!-- Multiple select filter using jQuery -->
    <script src="{{asset('web/js/custom-select.js')}}"></script>
    <!-- //Multiple select filter using jQuery -->
    <!-- start-smooth-scrolling -->
    <script src="{{asset('web/js/move-top.js')}}">
    </script>
    <script src="{{asset('web/js/easing.js')}}"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
            /*
             var defaults = {
            	 containerID: 'toTop', // fading element id
            	 containerHoverID: 'toTopHover', // fading element hover id
            	 scrollSpeed: 1200,
            	 easingType: 'linear'
             };
             */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="{{asset('web/js/SmoothScroll.min.js')}}"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('web/js/bootstrap.js')}}">
    </script>
    <!-- //Bootstrap Core JavaScript -->
</body>
</html>
